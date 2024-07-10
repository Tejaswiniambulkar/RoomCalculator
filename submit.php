<?php
session_start();

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "basil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$phone = $_POST['phone'] ?? null;
$property = $_POST['property'] ?? null;
$bhkType = $_SESSION['selectedBhkType'] ?? null;
$totalCost = $_SESSION['totalCost'] ?? null;
$package = $_SESSION['selectedPackage'] ?? null;
$roomSelections = json_encode($_SESSION['roomSelections'] ?? []);

if ($name && $email && $phone && $property && $bhkType && $totalCost && $package && $roomSelections) {
    $stmt = $conn->prepare("INSERT INTO info (name, email, phone, property)
     VALUES ('$name', '$email', '$phone', '$property')");

    if ($stmt->execute()) {
        echo "Record inserted successfully";

        // Send email
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;  
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true; 
            $mail->Username = 'tejaswini@howlindia.com'; 
            $mail->Password = 'nngu pbqg cdvw ziit'; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Port = 587; 

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('tejaswini@howlindia.com', 'Mailer');
            $mail->addAddress($email, $name);
            $mail->addCC('tejaswini@howlindia.com');
            $mail->addBCC('tejaswini@howlindia.com');

            $mail->isHTML(true); 
            $mail->Subject = 'Record Inserted Successfully';
            $mail->Body = "Hello $name,<br><br>Your record has been inserted successfully.<br><br>Details:<br>Name: $name<br>Email: $email<br>Phone: $phone<br>Property: $property<br>BHK Type: $bhkType<br>Total Cost: $totalCost<br>Package: $package<br>Room Selections: $roomSelections<br><br>Thank you.";

            $mail->send();
            echo 'Email has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirect to estimate.php
        header("Location: estimate.php");
        exit();
    } else {
        echo "Could not insert record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "All fields are required.";
}

$conn->close();
?>
