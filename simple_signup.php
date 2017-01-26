<?php 

	$link = mysqli_connect("localhost", "myuser", "mypassword", "mydatabase");

	if (mysqli_connect_error()) {

		die ("There was an error connecting to the database");

	}

// Check if the entire form has been fullfiled

    if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST) ){
         
        if($_POST['email'] == "") {
            
            echo "<p>Email adress is required</p>";
            
        } else if($_POST['password'] == "") {
            
            echo "<p>Password is required</p>";
         
// Check if the email addreess already exists            
        } else {
            
            $query = "SELECT `id` FROM `users` WHERE email ='".mysqli_real_escape_string($link, $_POST['email'])."'";
            
            $result = mysqli_query($link, $query);
            
            if  (mysqli_num_rows($result) > 0) {
                
              echo  "<p>That email adress has already been taken.</p>";
                
// If all goes well, the user will be signed up
                
            } else {
                
                $query = "INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (mysqli_query($link, $query)){
                     
                    echo "<p>You have been signed up.</p>";
                    
                } else {
                    
                    "<p>There was a problem signing you up - please try again later.</p>";
                    
                }
                
            }
        
        }
    }


 ?>

<h3>Please fullfil the form below</h3>
<form method="POST">
    
    <input name="email" type="text" placeholder="Email Address">
    <input name="password" type="text" placeholder="Password">
    <input type="submit" id="submitButton" value="Sign Up!">
    
</form>
