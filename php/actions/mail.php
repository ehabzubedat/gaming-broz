<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// The receiver
        $mail_to = "gamingboz2020@gmail.com";
        
        // Sender Data
        $subject = trim($_POST["subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email_from = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email_from, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
        	// Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }
        
		$headers = "From: " .$email_from;
		$txt = "You have recieved an e-mail from: ".$name.".\n\n".$message;

        // Send the email.
		$success = mail($mail_to, $subject, $txt, $headers);
		
		// if email sent succesfully
        if ($success) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Email sent succesfully.";
        } 
        else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Failed to send the email.";
		}
		
    } 
    else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>