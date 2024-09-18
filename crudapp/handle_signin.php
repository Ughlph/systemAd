<?php 
include 'db_connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $birthdate = htmlspecialchars($_POST["birthdate"]);
    $address = htmlspecialchars($_POST["address"]);

    if(empty($firstname || $lastname || $email || $password || $username || $gender|| $birthdate || $address)){
        exit();
        header("Location: /crudapp/index.php");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);



    $sql = "INSERT INTO users (firstname, lastname, email, password, username, gender, date_of_birth, address) VALUES ('$firstname', '$lastname', '$email', '$hashed_password', '$username', '$gender', '$birthdate', '$address')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    // Close the connection
    $conn->close();
    header("Location: /crudapp/login.php");
}
?>