<?php
    /**
     * Page to register
     * $user_register is the object of Register.class.php
     * Class is instantiated in dbconfig.php
    **/

    require_once "dbconfig.php";

    // Logged-in user cannot register
    if ( $user->is_loggedin() != "" ) {
        $user->redirect("index.php");
    }

    // If register form submit has been submitted, grab data
    // trim() to remove any whitespace
    if ( isset($_POST["register-button"]) ) {
        $name = trim($_POST["form-name"]);
        $email = trim($_POST["form-email"]);
        $password = trim($_POST["form-password"]);
        $confirmPassword = trim($_POST["confirm-password"]);

        // Validation for empty values
        if ($name == "") {
            $error[] = "Please provide your name";
        }
        else if ($email == "") {
            $error[] = "Please provide an email";
        }
        /**
         * Check if email is valid format
         * filter_var( $variable, filtername)
        **/
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Please enter a valid email address";
        }
        else if ($password == "") {
            $error[] = "You must create a password";
        }
        else if ($password != $confirmPassword) {
            $error[] = "Passwords entered do not match";
        }

        // If data is entered correctly
        else {
            try {
                /**
                 * Call to register() function (Register.class.php) and pass super global data
                 * If register() function call is successful, redirect authenticated user
                **/
                if ( $user_register->register( $name, $email, $password )) {
                    $user->redirect("register.php?joined");
                    //$user_login->login( $name, $email, $password );
                    //$user->redirect("index.php");
                }
            }

            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    } // Closing isset()

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register.php</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/ionicons.css">
    </head>
    <body>

        <a href="index.php" class="home"><i class="ion-ios-home"></i></a>
        <h1>Create Account</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <?php // If error variable set, loop and show the errors
                if ( isset($error) ) {
                    foreach( $error as $theError ) {
            ?>
                    <p class="error"><?php echo $theError; ?></p>
            <?php
                    }
                }

                // Grabs from the url
                else if (isset($_GET["joined"]) ) {
            ?>
                 <p class="success">Account successfully created. <a href="login.php">Login</a></p>

            <?php
                }
            ?>

            <input type="text" name="form-name" placeholder="Enter your name *" value="<?php if (isset($error)) { echo $name; } ?>" autofocus>
            <input type="email" name="form-email" placeholder="Enter your email *" value="<?php if (isset($error)) { echo $email; } ?>" >
            <input type="password" name="form-password" placeholder="Create a password *" >
            <input type="password" name="confirm-password" placeholder="Confirm password *" >
            <button type="submit" name="register-button">Create Account</button>

            <p class="required">* Required fields</p>

        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>

    </body>
</html>
