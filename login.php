<?php
    /**
     * Page to login
     * $user_login is the object of login.class.php
     * Class is instantiated in dbconfig.php
    **/

    require_once "dbconfig.php";

    // Logged-in user cannot login again
    if ( $user->is_loggedin() != "" ) {
        $user->redirect("index.php");
    }

    // If login button and form is sent
    if ( isset($_POST["login-button"]) ) {

        $email = $_POST["form-email"];
        $password = $_POST["form-password"];

        /**
         * Call to login() function (Login.class.php) and pass super global data
         * If login() function call is successful, redirect authenticated user
        **/
        if ( $user_login->login( $email, $password ) ) {
            $user->redirect("index.php");
        } else {
            $error = "Incorrect credentials - please try again";
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login.php</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/ionicons.css">
    </head>
    <body>
        <a href="index.php" class="home"><i class="ion-ios-home"></i></a>
        <h1>Login</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <?php // If error variable set, show the error
                if ( isset($error) ) {
            ?>
                    <p class="error"><?php echo $error; ?></p>
            <?php
                }
            ?>

            <input type="email" name="form-email" placeholder="Email" value="<?php if (isset($error)) { echo $email; } ?>" autofocus>
            <input type="password" name="form-password" placeholder="Password" >
            <button type="submit" name="login-button">Login</button>

        </form>

        <p>Don't have an account? <a href="register.php">Create Account</a></p>

    </body>
</html>
