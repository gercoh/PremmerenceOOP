<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.09.2018
 * Time: 10:51
 */


require("db.php");

$id =$_REQUEST['id'];

//Выборка данных для редактирования по ID пользователя

$resuser = mysqli_query($conn,"SELECT * FROM userdata WHERE id  = '$id'");



$testuser = mysqli_fetch_assoc($resuser);
if (!$resuser)
	die("Error: Data not found.");


//Присвоение данных из таблицы рабочим переменным

$name=$testuser['name'];

$email=$testuser['email'];

$countryid =$testuser['country_id'];



//Еще одна выборка уже с таблицы 'country' чтобы данные пользователя попали согласно его ID в таблицу

$rescountry = mysqli_query($conn,"SELECT * FROM usercountry WHERE id  = '$countryid'");

$row = mysqli_fetch_assoc($rescountry);
if (!$rescountry)
    die("Error: Data not found.");

//Присвоение данных из таблицы рабочим переменным

$idc = $row['country'];

if(isset($_POST['save']))
{

	$name_save = $_POST['name'];
	$email_save = $_POST['email'];
	$country_save = $_POST['country'];

	mysqli_query($conn,"UPDATE `userdata` SET name ='$name_save',email = '$email_save' WHERE id = '$id'")	or die(mysqli_error($conn));

    mysqli_query($conn,"UPDATE `usercountry` SET country ='$country_save' WHERE id = '$countryid'") or die(mysqli_error($conn));

//    echo "UPDATE `usercountry` SET country ='$country_save' WHERE id = '$countryid'";


//	echo "Saved!";

	header("Location: index.php");
}
mysqli_close($conn);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование</title>
</head>
<body>
<form method="post">
<table>
	<tr>
		<td>Название:</td>
		<td><input type="text" name="name" value="<?php echo $name ?>" size='15' /></td>
		<td><input type="text" name="email" value="<?php echo $email ?>" size='15' /></td>
		<td><input type="text" name="country" value="<?php echo $idc ?>" size='15' /></td>

		<td><input type="submit" name="save" value="Сохранить" /></td>
	</tr>
</table>
</body>
</html>