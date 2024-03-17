<?php
echo "
<style>
body {
    background-color: #a2b9c9; /* Change to your desired color */
}
.upload-success {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3em; /* Adjust as needed */
    text-align: center;
    width: 100%;
    z-index: 2; /* Ensure the text is above the fireworks */
}
#fireworks {
    position: absolute;
    z-index: 1; /* Ensure the fireworks are below the text */
}
.upload-error, .error-image {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2; /* Ensure the text and image are above the fireworks */
}
</style>
";

$target_dir = "pictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$allowedTypes = ['jpg', 'png', 'jpeg', 'gif', 'avif', 'webp']; // Define allowed file types

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if($check !== false && in_array($fileType, $allowedTypes)) {
        $uploadOk = 1;
    } else {
        echo "<div class='upload-error'>File is not an image.</div>";
        echo "<img src='media/sad.png' class='error-image' alt='Error Image'>";
        $uploadOk = 0;
    }
}

// Try to upload file if it's OK
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<div class='upload-success'>Picture Uploaded!</div>";
        echo "<script src='fireworks.js'></script>"; 
    } else {
        echo "<div class='upload-error'>Sorry, there was an error uploading your file.</div>";
        echo "<img src='media/sad.png' class='error-image' alt='Error Image'>";
    }
}

// JavaScript for redirecting after 3 seconds
echo "<script>setTimeout(function(){ window.location.href = 'start.php'; }, 3000);</script>";
?>
<?php


// Existing upload code here...

// Check if the file has been uploaded successfully
if ($uploadOk == 1 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<div class='upload-success'>Picture Uploaded!</div>";
    echo "<script src='fireworks.js'></script>";

    // Prepare to send the email
    $to = 'team@headstoneworldhouston.com';
    $subject = 'Uploaded Image';
    $message = 'An image has been uploaded.';
    $headers = "From: team@headstoneworldhouston.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"_1_\"\r\n";

    // Attachment
    $attachment = chunk_split(base64_encode(file_get_contents($target_file)));
    $filename = basename($target_file);

    // Message with attachment
    $body = "--_1_\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";
    $body .= "--_1_\r\n";
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
    $body .= $attachment . "\r\n";
    $body .= "--_1_--";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Email with attachment sent successfully.";
    } else {
        echo "Failed to send email with attachment.";
    }
} else {
    echo "<div class='upload-error'>Sorry, there was an error uploading your file.</div>";
    echo "<img src='media/sad.png' class='error-image' alt='Error Image'>";
}
?>
