<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.10.2018
 * Time: 13:47
 */

class UserController
{
    /**
     * Action для страницы списка пользователей
     */




    public  function  actionRegister()
    {

        // Переменные для формы
        $name = false;
        $email = false;
        $country = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $country = $_POST['country'];

            if ($_POST['submit']) {

                $result = User::register($name, $email, $country);
            }




        }
        require_once(ROOT . '/views/reg.php');



            if($result) {
//Простой и удобный способ перенапрваить пользователя
                echo ' <script language="JavaScript">
                        window.location.href = "http://users/"
                       </script>';

                return true;
            }
    }

    public function  actionDelete($id)
    {
        $db = Db::getConnection();


        $result2 = $db->query('SELECT country_id from userdata  WHERE id = '.$id.'');

        $usercidc = array();
        while ($row = $result2->fetch()) {
            $usercidc['id'] = $row['country_id'];
        }
        $idCid = $usercidc['id'];




        $sql3 = 'DELETE FROM usercountry WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result3 = $db->prepare($sql3);
        $result3->bindParam(':id', $idCid, PDO::PARAM_INT);
         $result3->execute();


        $sql4 = 'DELETE FROM userdata WHERE id = '.$id.'';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result4 = $db->prepare($sql4);

         $result4->execute();



        if($result4->execute()) {
//Простой и удобный способ перенапрваить пользователя
            echo ' <script language="JavaScript">
                        window.location.href = "http://users/"
                       </script>';

            return true;
        }





    }



    public  function  actionUpdate($id)
    {

        $marka = User::getUserbyId($id);



               // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $country = $_POST['country'];


            // Сохраняем изменения
            if(User::userUpdate($id, $name, $email, $country))
            {
                echo ' <script language="JavaScript">
                        window.location.href = "http://users/"
                       </script>';
            }

            // Перенаправляем пользователя на страницу управлениями заказами
//            header("Location: http://users/");
        }




        // Подключаем вид
        require_once(ROOT . '/views/update.php');
        return true;
    }

}