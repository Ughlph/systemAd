<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: /crudapp/login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Handle profile update
    if (isset($_POST['update'])) {
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $gender = htmlspecialchars($_POST["gender"]);
        $birthdate = htmlspecialchars($_POST["birthdate"]);
        $address = htmlspecialchars($_POST["address"]);

        // Prepare the SQL query
        $passwordQuery = "";
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $passwordQuery = "password = ?";
        }

        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, gender = ?, date_of_birth = ?, address = ?" . ($passwordQuery ? ", " . $passwordQuery : "") . " WHERE email = ?";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        if ($passwordQuery) {
            $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $username, $gender, $birthdate, $address, $hashedPassword, $_SESSION['email']);
        } else {
            $stmt->bind_param("sssssss", $firstname, $lastname, $email, $username, $gender, $birthdate, $address, $_SESSION['email']);
        }

        // Execute the statement
        $stmt->execute();

        // Update session variables
        $_SESSION['first_name'] = $firstname;
        $_SESSION['last_name']  = htmlspecialchars($_POST["lastname"]);
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username; 
        $_SESSION['gender'] = $gender; 
        $_SESSION['date_of_birth'] = $birthdate;
        $_SESSION['address'] = $address;
        if (!empty($password)) {
            $_SESSION['user_password'] = $password;
        }

        header("Location: ../crudapp/profile.php");
        exit();
    }

    // Handle account deletion
    if (isset($_POST['delete'])) {
        $email = $_SESSION['email'];

        // Delete user from the database
        $sql = "DELETE FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Destroy session and redirect to login page
        session_destroy();
        header("Location: ../crudapp/login.php");
        exit();
    }

    // Handle logout
    if (isset($_POST['logout'])) {
        // Destroy all session data
        session_unset();
        session_destroy();

        // Redirect to login page
        header("Location: ../crudapp/login.php");
        exit();
    }

}
?>
