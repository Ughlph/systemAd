<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

</head>
<body>
    <main>
        <h2>Sign In</h2>
        <form action="../crudapp/handle_signin.php" method="POST">
            <div class="form-group">
                <label for="firstname">First name</label>
                <input id="firstname" type="text" name="firstname" placeholder="Enter your first name" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last name</label>
                <input id="lastname" type="text" name="lastname" placeholder="Enter your last name" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="Enter your username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender </label>
                <select id="gender" type="text" name="gender" required>
                    <option value = "Male"> Male </option>
                    <option value = "Female"> Female </option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthdate">Birth Date</label>
                <input id="birthdate" type="date" name="birthdate" placeholder=" " required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" type="text" name="address" placeholder="Enter your address" required>
            </div>

            <button type="submit">Sign Up</button>
        </form>
        
        <div class="form-footer">
            <p>Already have an Account? <a href="../crudapp/login.php">   Sign In </a></p>
        </div>
    </main>
</body>


<style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #1a202c;
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main {
            background: #2d3748;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 400px;
        }

        input, select {
        padding: 0.8rem;
        border: 1px solid #4a5568;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #1a202c;
        color: #e2e8f0;
        transition: border-color 0.2s ease;
        }

        input:focus, select:focus {
        border-color: #63b3ed;
        outline: none;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #edf2f7;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-size: 0.9rem;
            color: #a0aec0;
        }

        input {
            padding: 0.8rem;
            border: 1px solid #4a5568;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #1a202c;
            color: #e2e8f0;
            transition: border-color 0.2s ease;
        }

        input:focus {
            border-color: #63b3ed;
            outline: none;
        }

        button {
            padding: 0.8rem;
            background-color: #3182ce;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2b6cb0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .form-group input {
            width: 100%;
        }

        .form-footer {
            margin-top: 0.9rem;
            text-align: center;
            font-size: 0.9rem;
            color: #a0aec0;
        }

        .form-footer a {
           
            color: #63b3ed;
            text-decoration: none;
        }

        .form-footer a:hover {
           
            text-decoration: underline;
        }
    </style>






</html>
