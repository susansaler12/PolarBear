<?php
require_once 'DBConnection.php';

class GordFeatures{

    //checks that two users are friends
    private function checkFriends($userOne, $userTwo){
        $db = DBConnection::getDB();
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
    private function searchProfiles($searchText){
        $db = DBConnection::getDB();
        if($searchText === null){
            $users = [];
        }else{
            $searchLike = '%'.$searchText.'%';
            $sqlQuery = "select concat(fname,' ',lname) as name, image, location from user_profiles where concat(fname,' ',lname) like :searchLike";
            $preparedQuery = $db->prepare($sqlQuery);
            $preparedQuery->bindParam(':searchLike',$searchLike, PDO::PARAM_STR, 101);
            $preparedQuery->execute();
            $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
            $users = $preparedQuery->fetchAll();
        }
        return $users;
    }

    //call searchProfiles and print a table of results
    public static function printUserSearch($searchText){
        $users = self::searchProfiles($searchText);
        if(count($users) === 0){
            return "<p>No users found.</p>";
        }else{
            $returnString = "
                <table>
                    <thead>
                        <th>Profile Photo</th>
                        <th>User Info</th>
                    </thead>
                    <tbody>
            ";
            foreach($users as $user){
                $returnString .= "
                    <tr>
                        <td><img src='".$user->image."' alt='Profile photo of ".$user->name."'/></td>
                        <td>
                            <p>$user->name</p>
                            <p>$user->location</p>
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
        $db = DBConnection::getDB();
        $sqlQuery = 'select fname, lname from user_profiles where id = :profileId';
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':profileId', $profileId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $profileInfo = $preparedQuery->fetch();
        return "$profileInfo->f_name $profileInfo->l_name";
    }

    //get events a user is attending
    private function getEvents($profileId){
        $db = DBConnection::getDB();
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
        $userId = null; // session data to get userId
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
        $db = DBConnection::getDB();
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
        $userId = null; // session data to get userId
        $resultString = "<section><h2>$userName's wishlist:</h2>";
        if(!self::checkFriends($profileId, $userId)  and $userId != $profileId){
            $resultString .= "<p>You must be friends with $userName to view their wishlist.</p>";
            return $resultString;
        }
        $wishlist = self::getWishlist($profileId);
        if(count($wishlist) === 0){
            $resultString .= "<p>$userName has no items on their wishlist.</p>";
        }else{
            $resultString .= "
                <table>
                    <thead>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
            ";
            foreach($wishlist as $item){
                $resultString .= "
                    <tr>
                        <td>$item->name</td>
                        <td>$item->category</td>
                        <td>$item->price</td>
                    </tr>
                ";
            }
            $resultString .= "</tbody></table></section>";
        }
        return $resultString;
    }

    //returns average rating of a given product
    public static function getAvgRating($productId){
        $db = DBConnection::getDB();
        $sqlQuery = "select avg(rating) as average from reviews where product_id = :productId";
        $preparedQuery = $db->prepare($sqlQuery);
        $preparedQuery->bindParam(':productId', $productId, PDO::PARAM_INT, 11);
        $preparedQuery->execute();
        $preparedQuery->setFetchMode(PDO::FETCH_OBJ);
        $result = $preparedQuery->fetch();
        if($result === false){
            return "No reviews";
        }
        return number_format($result->average,1);
    }

    //checks whether a user has submit a review for a given product
    private function checkHasReviewed($userId, $productId){
        $db = DBConnection::getDB();
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
        $db = DBConnection::getDB();
        $sqlQuery = 'select * from reviews where product_id = :productId order by post_date';
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
        $resultString = "<h2>Product Reviews<h2>";
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
        $db = DBConnection::getDB();
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
    public static function postReview($productId){
        $userId = null; // change to get userId from session var
        $rating = $_POST['reviewSelect'];
        $description = htmlspecialchars(trim($_POST['reviewText']));
        if($rating !== ''){
            $now = new DateTime();
            $postDate = $now->format('Y-m-d H:i:s');
            // figure out time zone
            self::createReview($userId, $productId, $rating, $description, $postDate);
        }
    }
}