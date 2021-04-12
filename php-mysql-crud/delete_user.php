<?php
include "connection.php";



if(isset($_GET['user_id'])){

    $user_id = $_GET['user_id'];

    $query = "DELETE FROM `users` WHERE `user_id` = :user_id";

    $statement = $connect->prepare($query);
    $result = $statement->execute(
        [
            ":user_id" => $user_id
        ]
    );

    if($result){

        echo "User deleted successfully";
        echo "<a href='./index.php'>Go to home</a>";

    }else{
        echo "failed to delete user";

    }
}else{
    echo 'user ID nahi milala';
}



?>