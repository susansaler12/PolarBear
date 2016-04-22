<?php

class invites
{
    function __construct()
    {}

    public static function invite_guests($event_id, $inviter, $invitee, $invite_priv){
        try {
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $inviteQuery = "INSERT INTO invites(event_id, inviter, invitee, invite_priv) VALUES(:event_id, :inviter, :invitee, :invite_priv);";
            $prepared = $db->prepare($inviteQuery);
            $prepared->bindParam(':event_id', $event_id);
            $prepared->bindParam(':inviter', $inviter);
            $prepared->bindParam(':invitee', $invitee);
            $prepared->bindParam(':invite_priv', $invite_priv);
            $prepared->execute();

            return "Your invite has been sent!";
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public static function view_invites($invitee){
        try{
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            $viewInvitesQuery = "SELECT * FROM invites WHERE invitee = :invitee;";
            $prepared = $db->prepare($viewInvitesQuery);
            $prepared->bindParam(':invitee', $invitee);
            $invites = $prepared->execute();

            return $invites;
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public static function confirm_invite($event_id, $invitee){
        try{
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $confirmQuery = "UPDATE invites SET confirmed := 1 WHERE event_id = :event_id AND invitee = :invitee;";
            $prepared = $db->prepare($confirmQuery);
            $prepared->bindParam(':event_id',$event_id);
            $prepared->bindParam(':invitee',$invitee);
            $prepared->execute();

            return "Thanks for confirming!";
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public static function clear_invite($event_id, $invitee){
        try{
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $deleteQuery = "DELETE FROM invites WHERE invitee = :invitee AND event_id = :event_id";
            $prepared = $db->prepare($deleteQuery);
            $prepared->bindParam(':invitee', $invitee);
            $prepared->bindParam(':event_id',$event_id);
            $prepared->execute();

            return "Invite Deleted";

        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }
}