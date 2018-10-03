<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.10.2018
 * Time: 14:11
 */

class User
{
    public static function getuserlist()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $result = $db->query('SELECT Userdata.id, name, email, country from Userdata JOIN usercountry ON Userdata.country_id = usercountry.id');

        // Получение и возврат результатов. Используется подготовленный запрос
        $i = 0;
        $userList = array();
        while ($row = $result->fetch()) {
            $userList[$i]['id'] = $row['id'];
            $userList[$i]['name'] = $row['name'];
            $userList[$i]['email'] = $row['email'];
            $userList[$i]['country'] = $row['country'];
            $i++;
        }
        return $userList;


    }
    /**
     * Регистрация пользователя
     * @param string $name <p>Имя</p>
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function register($name, $email, $country)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql1 = 'INSERT INTO usercountry (id, country) '
            . 'VALUES (null,:country)';

        $result1 = $db->prepare($sql1);

        $result1->bindParam(':country', $country, PDO::PARAM_STR);
        $result1->execute();

        $result2 = $db->query('SELECT max(id) from usercountry');
        $userc = array();
        while ($row = $result2->fetch()) {
            $userc['id'] = $row['max(id)'];
        }
        $idC = $userc['id'];


        $sql3 = 'INSERT INTO userdata (id, name, email, country_id) '
            . 'VALUES (null, :name, :email, :country_id)';

        $result3 = $db->prepare($sql3);
        $result3->bindParam(':name', $name, PDO::PARAM_STR);
        $result3->bindParam(':email', $email, PDO::PARAM_STR);
        $result3->bindParam(':country_id', $idC, PDO::PARAM_STR);
        return $result3->execute();






    }

    /**
     * Редактирование данных пользователя
     * @param integer $id <p>id пользователя</p>
     * @param string $name <p>Имя</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */


    public static function delete($id, $name, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();

    }

    public static function userUpdate($id, $name, $email,$country)
    {



        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE usercountry 
            SET country = :country 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':country', $country, PDO::PARAM_STR);
        $result->execute();



        $sql2 = "UPDATE userdata 
            SET name = :name, email=:email
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result2 = $db->prepare($sql2);
        $result2->bindParam(':id', $id, PDO::PARAM_INT);
        $result2->bindParam(':name', $name, PDO::PARAM_STR);

        $result2->bindParam(':email', $email, PDO::PARAM_STR);
        return $result2->execute();







    }

    public  static  function  getuserbyid($id)
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT  name, email, country from Userdata JOIN usercountry ON Userdata.country_id = usercountry.id where userdata.id = :id';

        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();


    }
}