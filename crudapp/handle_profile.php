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

        // Base query without password
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, username = ?, gender = ?, date_of_birth = ?, address = ?";

        // Parameters array
        $params = [$firstname, $lastname, $email, $username, $gender, $birthdate, $address];

        // Update password only if it's provided
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", password = ?";  // Append password update to SQL
            $params[] = $hashedPassword; // Add hashed password to params array
        }

        // Complete query by adding WHERE clause
        $sql .= " WHERE email = ?";
        $params[] = $_SESSION['email'];  // Add email as the last parameter

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Dynamically bind parameters based on the number of values in the array
        $types = str_repeat("s", count($params));  // Generate the correct types for bind_param
        $stmt->bind_param($types, ...$params);  // Use the unpacking operator to pass params dynamically

        // Execute the statement
        $stmt->execute();

        // Update session variables
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['gender'] = $gender;
        $_SESSION['birthdate'] = $birthdate;
        $_SESSION['address'] = $address;

        if (!empty($password)) {
            $_SESSION['user_password'] = $password; // Store new password if updated
        }

        // Redirect after update
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
