<?php
    /**
     * Page to logout
     * Page is fired when logout button is clicked and links to here
     * Redirects to index.php (home)
    **/

    require_once "dbconfig.php";

    // Call function, then redirect
    $user->logout();

    $user->redirect("index.php");

?>
