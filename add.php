<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.09.2018
 * Time: 10:50
 */

if(isset($_POST['submit'])){
    include 'db.php';
    if(isset($_POST['name'])&&(isset($_POST['email'])&&(isset($_POST['country'])))){

        $name = mysqli_real_escape_string($conn,$_POST['name']);

         $email = mysqli_real_escape_string($conn,$_POST['email']);

          $country = mysqli_real_escape_string($conn,$_POST['country']);

//        echo "INSERT INTO `Userdata`(id,name,email,country_id) VALUES (null,'$name',$email','$country')";

        mysqli_query($conn,"INSERT INTO usercountry(id,country) VALUES (null,'$country')");



        $sql =  mysqli_query($conn,"SELECT max(id) from usercountry") ;


//               echo "SELECT id from usercountry WHERE country = '$country'";

        $row = mysqli_fetch_assoc($sql);

         foreach ($row as $key=>$value)
            {
                $id = $value;

            }

        mysqli_query($conn,"INSERT INTO Userdata(id,name,email,country_id) VALUES (null,'$name','$email','$id')");


    }
}

header("Location: index.php");
?>