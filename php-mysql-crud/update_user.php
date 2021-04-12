<?php
include "connection.php";


if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $user_id = $_POST['user_id'];

    $query = "UPDATE
    `users`
SET
    `full_name` = :full_name,
    `email` = :email,
    `mobile` = :mobile,
    `gender` = :gender,
    `city` = :city,
    `timestamp` = :timestamp
WHERE
    `user_id` = :user_id";

    $statement = $connect->prepare($query);
    $result = $statement->execute(
        [
            ":full_name" => $full_name,
            ":email" =>$email,
            ":mobile" =>$mobile,
            ":gender" => $gender,
            ":city" => $city,
            ":timestamp" => $timestamp,
            ":user_id" => $user_id
        ]
    );

    if($result){
        echo 'Updated successfully';
        echo "<a href='./index.php'>Go to home</a>";
    }else{
        echo 'User update karayla nahi jamla!';
    }





}else if(isset($_GET['user_id'])){

    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
    $statement = $connect->query($query);

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

<div>
<h3>User registration update</h3>

<form action="update_user.php" method="post">
<table>

<tr>
<td>
Full name:
</td>
<td>
<input type="text" name="full_name" id="full_name" value="<?php echo $result[0]['full_name'];?>" required/>
</td>
</tr>

<tr>
<td>
Email:
</td>
<td>
<input type="text" name="email" id="email" value="<?php echo $result[0]['email'];?>" required/>
</td>
</tr>

<tr>
<td>
Mobile number:
</td>
<td>
<input type="text" name="mobile" id="mobile" value="<?php echo $result[0]['mobile'];?>" required/>
</td>
</tr>


<tr>
<td>
Gender: 
</td>
<td>
<?php echo $result[0]['gender'];?> <br>
<select name="gender" required>
<option>Select Gender</option>
<option value="female">Female</option>
<option value="male">Male</option>
<option value="other">other</option>
</select>
</td>
</tr>


<tr>
<td>
City: 
</td>
<td>
<input type="hidden" name="user_id" value="<?php echo $result[0]['user_id'];?>"/>

<input type="text" name="city" id="city" value="<?php echo $result[0]['city'];?>" required/>
</td>
</tr>


<tr>
<td>
</td>
<td>
<input type="submit" name="update" value="Update"/>
</td>
</tr>



</table>
</form>

</div>


    <?php

}else{
    echo 'user ID nahi milala';
}




?>