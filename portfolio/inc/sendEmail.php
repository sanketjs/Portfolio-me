<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    // Validate inputs
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad Request
        echo "Please fill in all the required fields with valid information.";
        exit();
    }

    // Set your email address
    $to = "thesuperheros811@gmail.com";

    // Email subject
    $subject = "New Contact Form Submission from $name";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email message
    $emailMessage = "Name: $name<br>";
    $emailMessage .= "Email: $email<br>";
    $emailMessage .= "Message:<br><br>$message";

    // Send the email
    if (mail($to, $subject, $emailMessage, $headers)) {
        http_response_code(200); // OK
        echo "Thank you! Your message has been sent successfully.";
    } else {
        http_response_code(500); // Internal Server Error
        echo "Oops! Something went wrong, and we couldn't send your message. Please try again later.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method.";
}
?>