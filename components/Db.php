<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.09.2018
 * Time: 10:48
 */
Class Db
{

    public static function  getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Задаем кодировку
        $db->exec("set names utf8");

        return $db;


    }


}