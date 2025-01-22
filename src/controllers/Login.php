<?php

namespace App\controllers;

// Import the Database and LoggedInUser class
use App\models\Database;
use App\models\LoggedInUser;

class Login {

    //this method auto-called before route on login page 
    public function beforeroute($f3){
        //Authorize if user is already logged in 
        if ($f3->get('SESSION.loggedIn')) {
            // if so, redirect to the welcome page with appropriate message
            $f3->reroute('/welcome/already-loggedin/');
        }
    }

    public function render($f3){

        //initialize template variables errorMessage and successMessage
        $f3->set("errorMessage", NULL);
        $f3->set("successMessage", NULL);
        // get the route parameter 'error' 
        $message = $f3->get("PARAMS.message");
        if($message === "invalid-credentials"){
            // set template variable $loginMessage 
            $f3->set("errorMessage","Invalid credentials. Please try again.");
        }
        else if($message === "not-loggedIn"){
            // set template variable $loginMessage 
            $f3->set("errorMessage","Please login first.");
        }
        else if($message === "signup-success"){
            // set template variable $loginMessage 
            $f3->set("successMessage","Sign-up successful! You can now log in to your account.");
        }
        // Render login page template
        echo \Template::instance()->render("/src/pages/login/login.php");
    }

    public function handleLogin($f3) {
        // get username and password from form
        $username = $f3->get('POST.username');
        $password = base64_encode($f3->get('POST.password'));
        
        // Authenticate user
        $LoggedInUser = $this->authenticate($username, $password);
        if ($LoggedInUser) {
            //set necessary session variables
            $f3->set('SESSION.loggedIn', true);
            // convert LoggedInUser obj to JSON to bypass serialize/unserialize issues
            $jsonLoggedInUser = json_encode([
                'id' => $LoggedInUser->getID(),
                'username' => $LoggedInUser->getUsername(),
                'access_level' => $LoggedInUser->getAccessLevel()
            ]);
            $f3->set('SESSION.LoggedInUser', $jsonLoggedInUser); 
            // Redirect to the welcome page after successful login
            $f3->reroute('/welcome');
        } else {
            // Set an error message in session
            $f3->set('SESSION.error', 'Invalid credentials. Please try again.');
            // Redirect back to the login page
            $f3->reroute('/login/invalid-credentials');
        }
    }

    // Authenticate the user by checking credentials in the database
    public function authenticate($username, $password) {
        try {
          
            // set database connection
            $db = new Database();
            // Get database connection
            $conn = $db->connect();
            
            // lets use a Mapper to work with Object-Relational Mapper (ORM) to query the BD:
            // tell Mapper which connection($conn) to use to connect to DB, and which table to see.
            $user = new \DB\SQL\Mapper($conn,"users");//At this point, the mapper object($user) does not contain any data yet (it is called "dry state")... wait for load()
            
            //the select query: from users table select/load those with username=$username, and password=$password (prepared statement)
            $user->load(array("username=? AND password=?",$username, $password));// now the mapper object($user) contains data. This process is called "auto-hydrating" the data mapper object. 

            // Check if the query returns data, i.e. if $user mapper is not dry..
            // dry(): returns TRUE if the cursor is not mapped to any database record, even if records have been load()ed.
            // dry() works after load() not after find() (and maybe not with other methods too)
            if (!$user->dry()) {
                //success
                //create a LoggedInUser object, disconnect from $db and return LoggedInUser object
                $LoggedInUser = new LoggedInUser($user->ID, $user->username, $user->access_level);
                $db->disconnect();
                return $LoggedInUser;
                //return true; // Success
            }
            return false; // Failure
            
        }
        catch (\DB\SQL $e) {
            echo "DB Error: " . $e->getMessage();
            return false;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

?>