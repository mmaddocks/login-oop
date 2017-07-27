<?php
    /**
     * Class to wrap the register() function
     * Extends User.class.php for access to $db property and __construct() method
     * Class is instantiated and object created in dbconfig.php
    **/

    class RegisterClass extends User
    {

        public function register( $name, $email, $password ) {

            try {
                // Encrypt password
                $new_password = password_hash( $password, PASSWORD_DEFAULT );

                // Prepare() - Prepares a statement for execution and returns a statement object
                // Passed into the statement varialbe ($stmt)
                $stmt = $this->db->prepare( "INSERT INTO users( user_name, user_email, user_password ) VALUES( :name, :email, :password)" );

                // bindparam binds a specified parameter to a variable
                // bindparam( parameter, $variable )
                $stmt->bindparam(":name", $name);
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":password", $new_password);
                $stmt->execute();

                return $stmt;
            }

            // Write error message
            catch( PDOException $e ) {
               echo $e->getMessage();
           }
        }

    }
?>
