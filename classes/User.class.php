<?php
    /**
     * Class to create new User object and connect to DB
     * Class is instantiated and object created in dbconfig.php
    **/

    class User
    {
        /**
         * Declare protected property (variable) - only accessible by this class and inheriting classes:
         * Login.class.php
         * Register.class.php
        **/
        protected $db;

        /**
         * Construct function - fired when new User object instantiated
         * Passes the database connection variable ($DB_con) into class's property ($db)
         * $this keyword references the object (User). Similar to $obj->prop outside of class
        **/
        function __construct($DB_con) {
            $this->db = $DB_con;
        }

        /**
         * Function to check if logged in
         * Check if the session variable name "user_session" exists
        **/
        public function is_loggedin() {

            if ( isset($_SESSION["user_session"]) ) {
                return true;
            }
        }

        /**
         * Function for easy page redirecting
         * Simply call redirect( "go_here.php" )
        **/
        public function redirect( $url ) {
            header( "Location: $url" );
        }

        /**
         * Function to call and destroy session (logout)
        **/
        public function logout() {
            session_destroy();
            unset($_SESSION['user_session']);
            return true;
        }

    }
?>
