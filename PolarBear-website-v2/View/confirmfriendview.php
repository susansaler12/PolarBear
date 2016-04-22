<?php

  $acceptfriend =  "<form action ='../Model/confirmfriend.php' method='post'>" .
    "<input type='submit' name='confirmfriend' value='Accept Friend Request'/>".
    "</form>";
    echo $acceptfriend . "<div>";

   $denyfriend =  "<form action ='../Model/denyfriend.php' method='post'>" .
    "<input type='submit' name='denyfriend' value='Deny Friend Request'/>".
    "</form>";
   echo $denyfriend . "<div>";
?>