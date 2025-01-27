<?php

namespace App\controllers;

// Import the Database class
use App\models\Database;

class EditPage extends Authorizer{

    public function render($f3, $params){
        
        //initialize template variable message
        $f3->set("message", NULL);
        //diffenrent implement of url params - here using function's parameters $params
        if(isset($params["error"]) && $params["error"] === "error-update"){
            $f3->set("message", "Failed to update your account. Please try again.");
        }
        else if(isset($params["error"]) && $params["error"] === "error-no-selected-user"){
            $f3->set("message", "No user(s) selected. Please try again.");
        }else if(isset($params["error"]) && $params["error"] === "not-loggedIn"){
            // set template variable $loginMessage 
            $f3->set("loginMessage","Please login first.");
        }
        
        // Get the json LoggedInUser from the SESSION
        $jsonLoggedInUser = $f3->get("SESSION.LoggedInUser");
        $userData = json_decode($jsonLoggedInUser);
        $f3->set("UserData", $userData);
        // $f3->set("UserID",$userData->id);
        // $f3->set("UserName",$userData->username);
        // $f3->set("UserAccess",$userData->access_level);
        
        // Fetch all users from the database (for admin view only)*******************
        if($userData->access_level == "Administrator"){
            
            $db = new Database();
            $connection = $db->connect();
            $usersResults = $connection->exec("SELECT ID, username FROM users");
            // Pass the users data(it is an array of arrays) to the template as template variable
            $Users = $f3->set("Users", $usersResults);  
        }
        
        $f3->set("pageTitle", "Edit Page");
        $f3->set("pageContent", \Template::instance()->render("/src/pages/editpage/editpage.php") );
        $f3->set("pageCss", '<link rel="stylesheet" href="/src/pages/editpage/editpage.css">');
        $f3->set("pageJS", NULL);
        //render Edit page
        echo \Template::instance()->render("/src/pages/layout.html");
    }

    public function submitNewDataSimpleUser($f3){
        // Get form data
        $newUsername = $f3->get('POST.username');
        $newPassword = base64_encode($f3->get('POST.password'));
        $userID = $f3->get("SESSION.LoggedInUser") ? json_decode($f3->get("SESSION.LoggedInUser"))->id : null;

        // Use the Database model to get the connection
        $db = new Database();
        $connection = $db->connect();

        //Update DB with user's data using Mapper
        
        $userSimple = new \DB\SQL\Mapper($connection,"users");
        $userSimple->reset();
        $userSimple->load(array("ID=?", $userID));
        $userSimple->username = $newUsername;
        $userSimple->password = $newPassword;
        $result = $userSimple->save();

        // Update DB with user's data using prepared statements
        // $result = $connection->exec(
        //     "UPDATE users SET username = ?, password = ? WHERE ID = ?", 
        //     [$newUsername, $newPassword, $userID]);

        // Disconnect from $db
        $db->disconnect();
        //print_r($result->cast());
        if ($result) {
            $f3->reroute('/welcome/success-update');
            return;
        } else {
            $f3->reroute('/editpage/error-update');
            return;
        }
    }

    public function submitNewDataAdminUser($f3){
        
        // get form data
        $selectedUsers = $f3->get("POST.selected_users");//includes selected user's IDs
        $usernames = $f3->get("POST.usernames");//includes selected user's IDs => Username-values (key => value)
        $passwords = $f3->get("POST.passwords");//includes selected user's IDs => Password-values (key => value)
        
        // if no users selected redirect to same page with an error message
        if (!$selectedUsers) {
            $f3->reroute('/editpage/error-no-selected-user');
            return;
        }

        // connect to db
        $db = new Database();
        $connection = $db->connect();
        
        //create Mapper for the DB
        $user = new \DB\SQL\Mapper($connection,"users");

        $rows_affected = 0;
        // for each selectedUser run a query to database using prepared statement.
        foreach ($selectedUsers as $selectedUserID) {
            
            
            $user->reset();
            $user->load(array("ID=?", $selectedUserID));
            $user->username = $usernames[$selectedUserID];
            $user->password = base64_encode($passwords[$selectedUserID]);
            $result = $user->save();
            
            // $rows = $connection->exec(
            //     "UPDATE users SET username = ?, password = ? WHERE ID = ?", 
            //     [ 
            //         $usernames[$selectedUserID], 
            //         base64_encode($passwords[$selectedUserID]), 
            //         $selectedUserID,
            //     ]
            // );
            
            //print_r($result->cast());
            if($result){
                $rows_affected++;
            }
        }

        // Disconnect from $db
        $db->disconnect();
        // after success redirect to welcome page with an success message
        $f3->reroute("/welcome/".$rows_affected."/updated-success");
        
    }
}

?>