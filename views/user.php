<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Категории</title>
</head>
<body>
<a href="http://users/user/register">Регистрация</a>
<br/>
<table border="1">

       <tr>
           <?php foreach ($users as $user): ?>
          <?php $iduser = $user['id'];?>


           <td> <?php echo $user['name'];?></td>
        <td> <?php echo  $user['email'];?></td>
        <td> <?php echo $user['country'];?></td>





        <td> <a href ='/user/update/<?php echo $iduser; ?>'>Редактировать</a>
        <td> <a href ='/user/deleted/<?php echo $iduser; ?>'>Удалить</a>

        </tr>

         <?php endforeach; ?>

</table>
</body>
</html>