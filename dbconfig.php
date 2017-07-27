<?php
    /**
     * Config file to connect to DB
     * Required on every file
    **/

    session_start();

    $DB_host = "localhost";
    $DB_user = "root";
    $DB_password = "root";
    $DB_name = "login_OOP";

    /**
     * Try block - connect to DB
     * PDO (PHP Data Object)
     * No spacing between connection=$variable
     * First line (host + db) = the DSN (Data source name)
    **/
    try {
        $DB_con = new PDO( "mysql:host=$DB_host; dbname=$DB_name", $DB_user, $DB_password );
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // If can't connect, catch error and display
    catch( PDOException $e ) {
        echo $e->getMessage();
    }

    /**
     * Create 3 new objects (instantiate appropriate class) and pass the database connection variable $DB_con
     * $DB_con passed into objects parameter to connect to the database
    **/
    require_once "classes/User.class.php";
    $user = new User($DB_con);

    require_once "classes/Login.class.php";
    $user_login = new LoginClass($DB_con);

    require_once "classes/Register.class.php";
    $user_register = new RegisterClass($DB_con);

?>
