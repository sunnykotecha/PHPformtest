<?php

//I have used PHP filter_vars to insure protection from numerous code injections and make the script attack-proof

$first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
$last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
$email_address = filter_var($_POST["email_address"], FILTER_SANITIZE_EMAIL);
$gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
$age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);
$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
$newsletter_opt_in = filter_var($_POST["newsletter_opt_in"], FILTER_SANITIZE_STRING);
$service = filter_var($_POST["service"], FILTER_SANITIZE_STRING);

//Open a new connection to the MySQL server
$conn = new mysqli('localhost', 'root', '', 'test');

//Output any connection error
if ($conn->connect_error)
{
    die('Error : (' . $conn->connect_error);
}
else
{

    $stmt = $conn->prepare("INSERT INTO form_submissions (first_name, last_name, email_address, gender, age, message, newsletter_opt_in, service) 
                   VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssisss", $first_name, $last_name, $email_address, $gender, $age, $message, $newsletter_opt_in, $service); //bind values and execute insert query
    $stmt->execute();
    echo "Form has been submitted successfully";
    $stmt->close();
    $conn->close();
}
?>
