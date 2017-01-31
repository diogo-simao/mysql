<?php

// Global variable because if its empty, an undefined index is generated - Have to solve this later.

$error= "";


    if(array_key_exists("submit", $_POST)) {
        
    // Normal connection checking
        
        $link = mysqli_connect("localhost", "cl59-secretd-iii", "fXdXxhct-", "cl59-secretd-iii");
            
            if(mysqli_connect_error()) {
                
                die ("Database Connetion Error");
                
            }
        
        
        // Check if the email input was filled 
        
            if(!$_POST['signUpEmail']) {
                
                $error .= "<p>A sign up email is required</p>";
                
            } 
         // Check if the password input was filled 
        
            if (!$_POST['signUpPassword']) {
                
                $error .= "<p>A sign up password is required</p>";
                
            }
        
            if ($error != "") {
                
                $error = "<p>There were error(s) in your form:</p>".$error;
                
        // If there's not any error, the inputs are checked against data in db.       
            
            } else {
                
                $query = "SELECT `id` FROM `users` WHERE email= '".mysqli_real_escape_string($link, $_POST['signUpEmail'])."'LIMIT 1";
                
                $result = mysqli_query($link, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    
                    $error = "That email address is taken";
              
        // If the user is new, the inputs are transformed in a new user in database          
                } else {
                    
                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['signUpEmail'])."', '".mysqli_real_escape_string($link, $_POST['signUpPassword'])."')";
                 
                // If any errors occurs during the INSERT
                    
                    if(!mysqli_query($link, $query)){
                        
                        $error = "<p>Could not sign you up - please try again later.</p>";
                 
                // If all goes well, the user is registered
                        
                    } else {
                        
                    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['signUpPassword'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        
                        mysqli_query($link, $query);
                        
                        echo "Sign up successfully";
                    }
                }
                
            } 
        
    }

?>
<p></p> 
<div id="error"><?php echo $error; ?> </div>
<form method="post">
<div id="errorMessage"></div>
<!-- Inputs for signing up -->  
   <fieldset>
        <input name="signUpEmail" type="text" placeholder="e.g. myemail@domain.com">
        <input name="signUpPassword" type="password" placeholder="Password">
        <input type="checkbox" name="stayLoggedIn" value="1">
        <input type="submit" value="Sign Up!" name="submit">
    </fieldset>
<!-- Inputs for logging in -->   
    <fieldset>
        <input name="logInEmail" type="text" placeholder="e.g. myemail@domain.com">
        <input name="logInPassword" type="password" placeholder="Password">
        <input type="checkbox" value="1">
        <input type="submit"  value="Log in!">
    </fieldset>
    
    
</form>
