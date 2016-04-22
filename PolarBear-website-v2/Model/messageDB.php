<?php
require_once 'DB_connection.php';

class MessageDB {

    public function updateMessage($msg_id,$subject,$content,$post_date){
    //these create a place holder that
        $db = DB_connection::getDB();//the place holder names can be anything, you don't need to worry about the single quotes.
        //this means you dont really need to create a exec file, since exec does not prevent sql injection
        $sql = "UPDATE messages SET
                    subject = :subject,
                    content = :content,
                    post_date = :post_date
                    WHERE msg_id = :msg_id ";
        $stm = $db->prepare($sql);
        $stm->bindParam(':msg_id', $msg_id);//these
        $stm->bindParam(':subject', $subject, PDO::PARAM_STR, 100);
        $stm->bindParam(':content', $content, PDO::PARAM_STR, 3000);
        $stm->bindParam(':post_date', $post_date, PDO::PARAM_STR);

        $count = $stm->execute();//returns number of rows affected.
        //always use the prepare statements as the sql injections can allow users to change the values of the table and allow for sql injections.
        //send bind param by reference and not value, as values will allow for users to directly change the content, but a referecne adds a certain amount of security.

        return "Updated rows: " . $count;
    }
}
?>