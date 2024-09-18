<?php
session_start();

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Check if email and password are empty
    if (empty($email) || empty($password)) {
        header("Location: /crudapp/login.php");
        exit();
    }

    // Updated SQL query to include firstname and lastname
    $sql = "SELECT firstname, lastname, email,username, gender,date_of_birth,address,password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);  // Prepare the SQL statement
    $stmt->bind_param("s", $email); // Bind the parameter to the placeholder
    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result();

    // Fetch the data
    if ($row = $result->fetch_assoc()) {
        $dbfirstname = $row['firstname'];
        $dblastname = $row['lastname'];
        $dbEmail = $row['email'];
        $dbPassword = $row['password'];
        $dbUsername = $row['username'];
        $dbBirthdate = $row['date_of_birth'];
        $dbGender = $row['gender'];
        $dbAddress = $row['address'];

        
        if (password_verify($password, $dbPassword)) {
            $_SESSION['firstname'] = $dbfirstname;
            $_SESSION['lastname'] = $dblastname;
            $_SESSION['email'] = $dbEmail;
            $_SESSION['password'] = $dbPassword;
            $_SESSION['username'] = $dbUsername;
            $_SESSION['birthdate'] = $dbBirthdate;
            $_SESSION['gender'] = $dbGender;
            $_SESSION['address'] = $dbAddress;
            $decryptedPassword = htmlspecialchars($_POST["email"]);
            $_SESSION['decyptedPassword'] = $decryptedPassword;
            header("Location: ../crudapp/profile.php");
            exit();
        } else {
            echo "Wrong password.";
        }

    } else {
        echo "No user found with that email.";
    }
}
?>