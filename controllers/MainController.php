<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 03.10.2018
 * Time: 13:40
 */

class MainController
{

    public function actionList()
    {
        $users = User::getuserlist();

        require_once(ROOT . '/views/user.php');
    }
}