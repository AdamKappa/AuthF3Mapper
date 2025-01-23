<?php

namespace App\controllers;

// Import the Database class
use App\models\Database;

class Signup extends AppController{
    public function render($f3){

        //initialize template variable message
        $f3->set("message", NULL);
        // get the route parameter 'message' 
        $message = $f3->get('PARAMS.message');
        // Based on the $message, set the template variable message
        if ($message === 'user-exist') {
            $f3->set("message","This username already exist!");
        }
        else if($message === "signup-failure"){
            $f3->set("message", "Failed to sign up. Please try again.");
        }
        
        //render Sign Up page
        echo \Template::instance()->render("src/pages/signup/signup.php");
    }

    public function handleSignup($f3){
        $newUserName = $f3->get("POST.username");
        $newUserPassword = base64_encode($f3->get("POST.password"));
        $newUserAccess = $f3->get("POST.access_level");

        // create a database connection
        $db = new Database();
        $connection = $db->connect();

        //first check if username already exist on DB table 'users'
        $user = new \DB\SQL\Mapper($connection,"users");
        // we use find(): returns an array of objects if finds.. else empty
        $existUser = $user->find(array("username=?", $newUserName));
        
        // Check if the find query returns data, 
        //i.e. if $existUser array is not empty(true) user exist
        if($existUser){
            $f3->reroute("/signup/user-exist");
            return;
        }

        //if user not exist create new user
        //first unset the mapper (to be save that Mapper does not keep the previous record..if ιτ contains it)
        $user->reset();
        //to use this way to get form data (from global vsariable POST)
        //The copyFrom('POST') or copyTo('POST'); method hydrates the mapper object with elements from framework array variable POST, 
        //the array keys of which (e.g. POST.username) must have names identical to the mapper object properties($user->username), 
        //which in turn correspond to the record's field names(in HTML field name="username"). 
        //$user->copyFrom("POST"); 
        //but this is way is considered as best practice (e.g. we want to encrypt the password before store it to DB)
        $user->username = $newUserName;
        $user->password = $newUserPassword;
        $user->access_level = $newUserAccess;
        $results = $user->save();// returns the new record's ID on success, 0 on failure

        //disconnect from $db
        $db->disconnect();

        if($results){
            $f3->reroute("/login/signup-success");
            return;
        }
        else {
            $f3->reroute("/signup/signup-failure");
            return;
        }

    }
}

?>