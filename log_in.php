<?php
    include 'db-conect.php';
    session_start(); 

    if (isset($_POST['signup'])) {
        $UserName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = "SELECT * FROM utilisateurs WHERE email = '$email'";
        $result_email = $conn->query($checkEmail);

        $checkUser = "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$UserName'";
        $result_user = $conn->query($checkUser);
        
        if ($result_email->num_rows > 0) {
            $_SESSION['email_exist'] = "Email Address Already Exists!!!";
        } else if ($result_user->num_rows > 0) {
            $_SESSION['UserName_exist'] = "UserName Address Already Exists!!!";
        } else {
            $insertQuery = "INSERT INTO utilisateurs(nom_utilisateur, mot_de_pass, email) VALUES ('$UserName', '$password', '$email')";
            if ($conn->query($insertQuery) == TRUE) {
                $_SESSION['succesfull_signup'] = "Signup successful";
            } else {
                $_SESSION['signup_error'] = "Error: " . $conn->error;
            }
        }
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkEmail = "SELECT * FROM utilisateurs WHERE email = '$email'";
        $result = $conn->query($checkEmail);
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['mot_de_pass'])) {
                $_SESSION['user_id'] = $user['id_utilisateur'];
                $_SESSION['username'] = $user['nom_utilisateur'];

                $checkAdmin = "SELECT * FROM utilisateurs ORDER BY id_utilisateur LIMIT 1"; // Getting the first user (admin)
                $adminResult = $conn->query($checkAdmin);
                $admin = $adminResult->fetch_assoc();

                if ($user['email'] === $admin['email']) {
                    $_SESSION['is_admin'] = true;
                } else {
                    $_SESSION['is_admin'] = false;
                }

                if ($_SESSION['is_admin']) {
                    header("Location: admin/dashboard.php");
                } else {
                    header("Location: user/user_home.php");
                }
            } else {
                $_SESSION['login_error'] = "Incorrect Password!";
            }
        } else {
            $_SESSION['login_error'] = "No Account Found With That Email!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        input:focus {
            border-color: #007BFF;
        }

        .button {
            padding: 12px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .hidden {
            display: none;
        }

        .signup-btn, .login-btn {
            cursor: pointer;
            color: #007BFF;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        .success-message {
            color: green;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Signup Form -->
        <div class="form-container signup-form">
            <h2>Signup</h2>
            <form id="signup-form" class="form" method="post" action="log_in.php">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <input class="button" type="submit" value="SIGN UP" name="signup">
                
                <!-- Signup Success or Error Message -->
                <?php
                    if (isset($_SESSION['succesfull_signup'])) {
                        echo "<p class='success-message'>" . $_SESSION['succesfull_signup'] . "</p>";
                        unset($_SESSION['succesfull_signup']);
                    }
                    if (isset($_SESSION['email_exist'])) {
                        echo "<p class='error-message'>" . $_SESSION['email_exist'] . "</p>";
                        unset($_SESSION['email_exist']);
                    }
                    if (isset($_SESSION['signup_error'])) {
                        echo "<p class='error-message'>" . $_SESSION['signup_error'] . "</p>";
                        unset($_SESSION['signup_error']);
                    }
                    if (isset($_SESSION['UserName_exist'])) {
                        echo "<p class='error-message'>" . $_SESSION['UserName_exist'] . "</p>";
                        unset($_SESSION['UserName_exist']);
                    }
                ?>
                <p>Already have an account? <span class="login-btn" style="color: blue;">Log in</span></p>
            </form>
        </div>

        <!-- Login Form -->
        <div class="form-container login-form hidden">
            <h2>Login</h2>
            <form id="login-form" class="form" method="post" action="log_in.php">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required>

                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>

                <input class="button" type="submit" value="LOG IN" name="login">
                
                <!-- Login Error Message -->
                <?php
                    if (isset($_SESSION['login_error'])) {
                        echo "<p class='error-message'>" . $_SESSION['login_error'] . "</p>";
                        unset($_SESSION['login_error']);
                    }
                ?>
                <p>Don't have an account? <span class="signup-btn" style="color: blue;">Sign up</span></p>
            </form>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
