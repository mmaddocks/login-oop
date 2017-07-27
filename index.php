<?php
    /**
     * The default page for authenticated or non-authenticated users
     * dbcongig.php file required for session_start()
    **/
    require_once "dbconfig.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index.php</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/ionicons.css">
    </head>
    <body>

<?php
    // If user is logged in (Session is NOT empty and set to user_id)
    if ( $user->is_loggedin() != "" ) {

        // $user->redirect("home.php"); <- Alternative = Send to another page

        /**
         * Set $user_id variable to the session (the user_id grabbed from DB)
         * Query the DB WHERE user_id value = KEY in below array
         * The KEY's value is the $user_id variable, which is the session, which is the user_id in DB
         * $userRow variable stores the entire DB row as an array KEY(column name) => VALUE(db value)
        **/
        $user_id = $_SESSION["user_session"];
        $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->execute( array(":user_id" => $user_id) );
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

?>
        <i class="ion-happy-outline"></i>
        <h1>Welcome <?php print($userRow["user_name"]); ?>!</h1>
        <h2>Maybe it's not that amazing.</h2>
        <a href="logout.php">Logout</a>


    <?php
        /* If not authenticated user. Show the below */
        } else { ?>
        <i class="ion-ios-locked"></i>
        <h1>Amazing content ahead. Trust me.</h1>
        <p>You need to <a href='login.php'>login</a> or <a href='register.php'>create an account.</a></p>

    <?php } ?>

    </body>
</html>
