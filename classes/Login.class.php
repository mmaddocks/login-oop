<?php
    /**
     * Class to wrap the login function
     * Extends User.class.php for access to $db property and __construct() method
     * Class is instantiated and object created in dbconfig.php
    **/

    class LoginClass extends User
    {

        public function login( $email, $password ) {

            // Query DB - where value is the KEY to the array below
            try {
                $stmt = $this->db->prepare( "SELECT * FROM users WHERE user_email = :email LIMIT 1" );
                // Execute statement and passing an array of insert values with named key
                $stmt->execute( array( ":email" => $email) );
                // $userRow variable stores the entire DB row as an array KEY(column name) => VALUE(db value)
                $userRow = $stmt->fetch( PDO::FETCH_ASSOC );

                /**
                 * If a row exists check the password
                 * rowCount() returns the number of rows affected by SQL statement
                **/
                if ( $stmt->rowCount() > 0 ) {

                    /**
                     * If password is verified, set the session variable to the user_id from DB
                     * password_verify( $password_entered , $encrypted_password_on_DB )
                    **/
                    if ( password_verify( $password, $userRow["user_password"] ) ) {
                        $_SESSION["user_session"] = $userRow["user_id"];
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            // Write error message
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

    }

?>
