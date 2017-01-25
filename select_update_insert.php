<?php 

	$link = mysqli_connect("localhost","my_user","my_password","my_db");

	// stop the connection if retuns an error
  
  if (mysqli_connect_error()) {

		die ("There was an error connecting to the database");

	} 

   // select and return data from a specific table

      $query = "SELECT * FROM users";

        if ($result = mysqli_query($link, $query)) {

            $row = mysqli_fetch_array($result);

            echo "Your id is ".$row['id']."<br>";
            echo "Your email is ".$row["email"]."<br>";
            echo "Your password is ".$row["password"]."<br>";

        }
      
      //inserting data to a table - make a comment to not insert all the times that the query runs

    // $query = "INSERT INTO `users` (`email`, `password`) VALUES('myemail@mydomain', 'mypassword')";

    //updating data to an specific id

    $query = "UPDATE `users` SET password = 'XYZ123' WHERE email = 'robpercival@gmail.com' LIMIT 1";

    mysqli_query($link, $query);

 ?>
