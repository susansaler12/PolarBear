<?php
require_once 'dbclass.php';

class LoginDB {

    public function updatePassword($id,$email,$password){
    //these create a place holder that
        $db = Dbclass::getDB();//the place holder names can be anything, you don't need to worry about the single quotes.
        //this means you dont really need to create a exec file, since exec does not prevent sql injection
        $sql = "UPDATE user_profiles SET
                    email = :email,
                    password = :password
                    WHERE id = :id ";
        $stm = $db->prepare($sql);
        $stm->bindParam(':id', $id);//these
        $stm->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $stm->bindParam(':password', $password, PDO::PARAM_STR, 32);

        $count = $stm->execute();//returns number of rows affected.
        //always use the prepare statements as the sql injections can allow users to change the values of the table and allow for sql injections.
        //send bind param by reference and not value, as values will allow for users to directly change the content, but a referecne adds a certain amount of security.

        return "Updated rows: " . $count;
    }
}
?>