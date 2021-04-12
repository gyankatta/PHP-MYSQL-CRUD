<?php
include "connection.php";

if(isset($_POST['submit'])){


    if(isset($_POST['full_name'])&&
    isset($_POST['email'])&&
    isset($_POST['mobile'])&&
    isset($_POST['gender'])&&
    isset($_POST['city'])){

        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];

        $query = "INSERT INTO `users`(`full_name`, `email`, `mobile`, `gender`, `city`, `timestamp`) 
        VALUES (:full_name,:email,:mobile,:gender,:city,:timestamp)";

        $statement = $connect->prepare($query);
        $result = $statement->execute(
            [
                ":full_name" => $full_name,
                ":email" => $email,
                ":mobile" => $mobile,
                ":gender" => $gender,
                ":city" => $city,
                ":timestamp" => $timestamp
            ]
        );

        if($result){

            echo 'Success';
        }else{
            echo 'Failed';
        }



    }else{
        echo 'Invalid paramter received';
    }
}else{
   // echo 'Not submitted';
}


?>

<html>
<head>
<title>
PHP CRUD Operations
</title>
</head>
<body>

<div>
<h3>User registration form</h3>


<form action="" method="post">


<table>

<tr>
<td>
Full name:
</td>
<td>
<input type="text" name="full_name" id="full_name" placeholder="Enter your full name"/>
</td>
</tr>

<tr>
<td>
Email:
</td>
<td>
<input type="text" name="email" id="email" placeholder="Enter your email"/>
</td>
</tr>

<tr>
<td>
Mobile number:
</td>
<td>
<input type="text" name="mobile" id="mobile" placeholder="Enter your mobile number"/>
</td>
</tr>


<tr>
<td>
Gender: 
</td>
<td>
<select name="gender">
<option>Select Gender</option>
<option value="female">Female</option>
<option value="male">male</option>
<option value="other">other</option>
</select>
</td>
</tr>


<tr>
<td>
City: 
</td>
<td>
<input type="text" name="city" id="city" placeholder="Enter your city"/>
</td>
</tr>


<tr>
<td>
</td>
<td>
<input type="submit" name="submit" value="Submit"/>
</td>
</tr>



</table>
</form>

</div>



<div>
<h3>List of all users</h3>

<table>
<tr>
<th> User ID </th>
<th> Full name </th>
<th> Email </th>
<th> Mobile </th>
<th> Gender </th>
<th> City </th>
<th> Timestamp </th>
<th> Update </th>
<th> Delete </th>
<th> Remove </th>
</tr>

<?php

$query = "SELECT * FROM `users` WHERE `status` = 'Active'";

$statement = $connect->query($query);
$result = $statement->fetchAll();

if($result){
    //code to display list of users
    $rows = count($result);
    for($i=0;$i<$rows;$i++){
        ?>
<tr>
<td><?php echo $result[$i]['user_id'];?></td>
<td><?php echo $result[$i]['full_name'];?></td>
<td><?php echo $result[$i]['email'];?></td>
<td><?php echo $result[$i]['mobile'];?></td>
<td><?php echo $result[$i]['gender'];?></td>
<td><?php echo $result[$i]['city'];?></td>
<td><?php echo $result[$i]['timestamp'];?></td>
<td>
<a href="update_user.php?user_id=<?php echo $result[$i]['user_id'];?>">Update</a>
<a href="delete_user.php?user_id=<?php echo $result[$i]['user_id'];?>">Delete</a>
<a href="remove_user.php?user_id=<?php echo $result[$i]['user_id'];?>">Remove</a>
</td>
</tr>

        <?php
    }


}else{
    echo 'User fetch karayla nahi jamle';
}


?>


</table>
</div>

</body>
</html>