<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array(); // To store validation errors

    // Validate and sanitize form data
    $fullName = sanitizeInput($_POST["fullName"]);
    $email = sanitizeInput($_POST["email"]);
    $phone = sanitizeInput($_POST["phone"]);
    $selectedJob = sanitizeInput($_POST["jobSelect"]);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Process the uploaded resume
    $resumeUploadDir = "uploads/";
    $resumeFileName = basename($_FILES["resume"]["name"]);
    $resumeFilePath = $resumeUploadDir . $resumeFileName;

    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $resumeFilePath)) {
        // File uploaded successfully
        $resumeMessage = "Resume uploaded successfully.";
    } else {
        // Error uploading file
        $resumeMessage = "Resume upload failed.";
    }

    if (empty($errors)) {
        // No validation errors
        echo "Thank you for applying, $fullName!";
        echo "<br>";
        echo "You applied for the position: $selectedJob";
        echo "<br>";
        echo "Resume: $resumeMessage";

        // In a real application, you would now insert the data into a database or send an email
    } else {
        // Validation errors occurred
        echo "Validation errors:";
        foreach ($errors as $error) {
            echo "<br>" . $error;
        }
    }
}

function sanitizeInput($input) {
    // Sanitize input by removing potentially harmful characters
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
