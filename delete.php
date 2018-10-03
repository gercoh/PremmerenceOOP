<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.09.2018
 * Time: 10:52
 */

include("db.php");

$id =$_REQUEST['id'];

// sending query

//Так как Удалить нужно инфу из 2-ух таблиц по текущему юзеру согласно его ID, я делаю выборку в primаry таблице.
$sql =  mysqli_query($conn,"SELECT * from userdata where id = '$id'") ;

//echo "SELECT country_id from userdata where id = '$id'";

$row = mysqli_fetch_assoc($sql);

$idc = $row['country_id'];
//echo $idc;



mysqli_query($conn,"DELETE FROM usercountry WHERE id = '$idc'") or die(mysqli_error($conn));

mysqli_query($conn,"DELETE FROM userdata WHERE id = '$id'") or die(mysqli_error($conn));


header("Location: index.php");

?>