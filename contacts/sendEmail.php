<?php

require('../wp-content/process/mail.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $email = "Defipross@gmail.com";
     $name = isset($_POST['form_fields']['name']) ? $_POST['form_fields']['name'] : '';
     $senderEmail = isset($_POST['form_fields']['email']) ? $_POST['form_fields']['email'] : '';
     $message = isset($_POST['form_fields']['message']) ? $_POST['form_fields']['message'] : '';
     $subject = "A Message from your site sent from " . $name;

     // Check if required fields are not empty
     if (!empty($name) && !empty($senderEmail) && !empty($message)) {
          // Additional validation if needed

          // Call the sendMail function
          sendMail($email, $senderEmail, $subject, $message);

          header("Location: index.php");
          exit;
     } else {
          // Handle the case where required fields are empty
          echo "Please fill in all the required fields.";
     }
}
