<?php

Class events{

    public static function getAll(){
        $db = DB_connection::getDB();
        $query = "SELECT * FROM events";
        $result = $db->query($query);
        $rows = $result->fetchAll();
        return $rows;
    }

    public static function getEventsForUser($invitee){
        $db = DB_connection::getDB();
        //$query = "SELECT * FROM events WHERE event_id IN (SELECT e.event_id FROM events e JOIN invites i ON e.event_id = i.event_id WHERE invitee = :invitee)";
        $query = "SELECT * FROM events e JOIN invites i ON e.event_id = i.event_id WHERE invitee = :invitee";
        $prepared = $db->prepare($query);

        $prepared->bindParam(':invitee',$invitee);

        $prepared->execute();
        $rows = $prepared->fetchAll();

        return $rows;
    }

    public static function newEvent($event_descrip,$event_date, $event_location, $event_creator, $guest_of_honor, $surprise_for){
        try {
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $insert = "INSERT INTO events(event_descrip, event_date, event_location, event_creator, guest_of_honor, surprise_for)
                  VALUES(:event_descrip, :event_date, :event_location, '$event_creator', :guest_of_honor, :surprise_for);";
            $prepared = $db->prepare($insert);

            $prepared->bindParam(':event_descrip', $event_descrip);
            $prepared->bindParam(':event_date', $event_date);
            $prepared->bindParam(':event_location', $event_location);
            $prepared->bindParam(':guest_of_honor', $guest_of_honor);
            $prepared->bindParam(':surprise_for', $surprise_for);
            $prepared->execute();

            return "New row inserted";
        }
        catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public static function deleteEvent($event_id){
        try{
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $deletion = "DELETE FROM events WHERE event_id = :event_id;";
            $prepared = $db->prepare($deletion);
            $prepared->bindParam(':event_id', $event_id);
            $prepared->execute();

            return "Event deleted Successfully";
        }
        catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public static function getEvent($event_id){
        $db = DB_connection::getDB();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $query = "SELECT * FROM events WHERE event_id = $event_id";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

    public static function updateEvent($event_id, $event_descrip,$event_date, $event_location, $guest_of_honor, $surprise_for){
        try {
            $db = DB_connection::getDB();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $update = "UPDATE events SET event_descrip := :event_descrip, event_date := :event_date, event_location := :event_location, guest_of_honor := :guest_of_honor, surprise_for := :surprise_for WHERE event_id = :event_id;";

            $prepared = $db->prepare($update);

            $prepared->bindParam(':event_descrip', $event_descrip);
            $prepared->bindParam(':event_date', $event_date);
            $prepared->bindParam(':event_location', $event_location);
            $prepared->bindParam(':guest_of_honor', $guest_of_honor);
            $prepared->bindParam(':surprise_for', $surprise_for);
            $prepared->bindParam(':event_id', $event_id);
            $prepared->execute();

            return "Row Updated Successfully";
        }
        catch (PDOException $e){
            return $e->getMessage();
        }
    }
}
