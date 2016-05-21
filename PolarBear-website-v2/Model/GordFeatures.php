<?php
require_once 'DB_connection.php';

class GordFeatures{

    //checks that two users are friends
    private function checkFriends($userOne, $userTwo){
        $db = DB_connection
            ::getDB();
        $sqlQuery = "select * from friendlist where id = :userOne and idfriend = :userTwo and status = 1";
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':userOne', $userOne, PDO::PARAM_STR, 50);
        $preparedQuery->bindParam(':userTwo', $userTwo, PDO::PARAM_STR, 50);
        $preparedQuery->execute();
        $result = $preparedQuery->fetch();
        if($result !== false){
            return true;
        }
        $tempVar = $userOne;
        $userOne = $userTwo;
        $userTwo = $tempVar;
        $preparedQuery->execute();
        $result = $preparedQuery->fetch();
        if($result !== false){
            return true;
        }
        return false;
    }

    //search for profiles by name
    public static function searchProfiles($searchText){
        $db = DB_connection
            ::getDB();
        if($searchText === null){
            $users = [];
        }else{
            $quote = $db->quote($searchText);
            $sqlQuery = "select id, full_name, image, location from user_profiles where match(full_name) against($quote)";
            $preparedQuery = $db->prepare($sqlQuery);
            $preparedQuery->execute();
            $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
            $users = $preparedQuery->fetchAll();
        }
        return $users;
    }

    //get profile image pathname
    public static function profileImagePath($filename){
        return '../uploads/' . $filename;
    }

    //call searchProfiles and print a table of results
    public static function printUserSearch($searchText){
        $users = self::searchProfiles($searchText);
        if(count($users) === 0){
            return "<p>No users found.</p>";
        }else{
            $returnString = "
                <table class='table table-striped'>
                    <thead>
                        <th>Profile Photo</th>
                        <th>User Info</th>
                        <th>Invite Friend</th>
                    </thead>
                    <tbody>
            ";
            foreach($users as $user){
                $imagePath = self::profileImagePath($user->image);
                $returnString .= "
                    <tr>
                        <td><img src='$imagePath' alt='Profile photo of $user->full_name'/></td>
                        <td>
                            <p><a href='../View/showfriendprofile.php?friendid=$user->id'>$user->full_name</a></p>
                            <p>$user->location</p>
                        </td>
                        <td>
                            <form action='../Model/addfriend.php' method='post'>
                                <input type='hidden' name='id' value='$user->id'/>
                                <input type='submit' name='addFriendSubmit' value='Invite'/>
                            </form>
                        </td>
                    </tr>
                ";
            }
            $returnString .= "</tbody></table>";
            return $returnString;
        }
    }

    //get user's name from db
    private function getName($profileId){
        $db = DB_connection
            ::getDB();
        $sqlQuery = 'select full_name from user_profiles where id = :profileId';
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':profileId', $profileId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $profileInfo = $preparedQuery->fetch();
        return $profileInfo->full_name;
    }

    //get events a user is attending
    private function getEvents($profileId){
        $db = DB_connection
            ::getDB();
        $sqlQuery = 'select event_descrip as description, event_date as date from events where event_id in (select event_id from invites where invitee = :profileId and confirmed = 1)';
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':profileId', $profileId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $events = $preparedQuery->fetchAll();
        return $events;
    }

    //prints table of events a user is attending
    public static function printEvents($profileId){
        $userName = self::getName($profileId);
        $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $resultString = "<section><h2>Events that $userName is attending:</h2>";
        if(!self::checkFriends($profileId, $userId) and $userId != $profileId){
            $resultString .= "<p>You must be friends with $userName to view their event list.</p>";
            return $resultString;
        }
        $events = self::getEvents($profileId);
        if(count($events) === 0){
            $resultString .= "<p>$userName has not confirmed attendance to any events.</p>";
        }else{
            $resultString .= "
                <table>
                    <thead>
                        <th>Description</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
            ";
            foreach($events as $event){
                $resultString .= "
                    <tr>
                        <td>$event->description</td>
                        <td>$event->date</td>
                    </tr>
                ";
            }
            $resultString .= "</tbody></table></section>";
        }
        return $resultString;
    }

    //get a user's wishlist
    private function getWishlist($profileId){
        $db = DB_connection
            ::getDB();
        $sqlQuery = 'select name, category, price from products where product_id in (select product_id from wishlist where id = :profileId)';
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':profileId', $profileId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $wishlist = $preparedQuery->fetchAll();
        return $wishlist;
    }

    //prints table of user's wishlist
    public static function printWishlist($profileId){
        $userName = self::getName($profileId);
        $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $resultString = "<section><h2>$userName's wishlist</h2>";
        if(!self::checkFriends($profileId, $userId)  and $userId != $profileId){
            $resultString .= "<p>You must be friends with $userName to view their wishlist.</p>";
            return $resultString;
        }
        $wishlist = self::getWishlist($profileId);
        if(count($wishlist) === 0){
            $resultString .= "<p>$userName has no items on their wishlist.</p>";
        }else{
            $resultString .= "
                <table class='table table-striped'>
                    <thead>
                        <th>Product Name</th>
                        <th>Product Category</th>
                    </thead>
                    <tbody>
            ";
            foreach($wishlist as $item){
                $resultString .= "
                    <tr>
                        <td>$item->name</td>
                        <td>$item->category</td>
                    </tr>
                ";
            }
            $resultString .= "</tbody></table></section>";
        }
        return $resultString;
    }

    //returns average rating of a given product
    public static function getAvgRating($productId){
        $db = DB_connection
            ::getDB();
        $sqlQuery = "select avg(rating) as average from reviews where product_id = :productId";
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':productId', $productId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $result = $preparedQuery->fetch();
        $resultFormat = number_format($result->average,1);
        if($resultFormat === '0.0'){
            return "No reviews";
        }
        return $resultFormat;
    }

    //checks whether a user has submit a review for a given product
    public static function checkHasReviewed($userId, $productId){
        $db = DB_connection
            ::getDB();
        $sqlQuery = "select * from reviews where user_id = :userId and product_id = :productId";
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':userId', $userId, PDO::PARAM_INT, 11);
        $preparedQuery->bindParam(':productId', $productId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $result = $preparedQuery->fetch();
        if($result !== false){
            return true;
        }
        return false;
    }

    //gets all reviews for a given product
    private function getReviews($productId){
        $db = DB_connection
            ::getDB();
        $sqlQuery = 'select * from reviews where product_id = :productId order by post_date desc';
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':productId', $productId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $reviews = $preparedQuery->fetchAll();
        return $reviews;
    }

    //prints reviews of a given product
    public static function printReviews($productId){
        $reviews = self::getReviews($productId);
        $resultString = '';
        if(count($reviews) === 0){
            $resultString .= "<p>This product has not yet been reviewed.</p>";
        }else{
            foreach($reviews as $review){
                $username = self::getName($review->user_id);
                $resultString .= "
                    <article>
                        <h3>User: $username</h3>
                        <p>Posted: $review->post_date</p>
                        <p>Score: $review->rating</p>
                        <p><b>Comments: </b>$review->description</p>
                    </article>
                ";
            }
        }
        return $resultString;
    }

    //creates new review
    private function createReview($userId, $productId, $rating, $description, $postDate){
        $db = DB_connection
            ::getDB();
        $sqlQuery = 'insert into reviews values (:userId, :productId, :rating, :description, :postDate)';
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':userId', $userId, PDO::PARAM_INT, 11);
        $preparedQuery->bindParam(':productId', $productId, PDO::PARAM_INT, 11);
        $preparedQuery->bindParam(':rating', $rating, PDO::PARAM_INT, 11);
        $preparedQuery->bindParam(':description', $description, PDO::PARAM_STR, 300);
        $preparedQuery->bindParam(':postDate', $postDate, PDO::PARAM_STR);
        return $preparedQuery->execute();
    }

    //takes post data and creates new review
    public static function postReview($userId, $productId, $rating, $comment){
        if($rating !== ''){
            $now = new DateTime();
            $postDate = $now->format('Y-m-d H:i:s');
            // figure out time zone
            return self::createReview($userId, $productId, $rating, $comment, $postDate);
        }
        return false;
    }
}