<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02.10.2018
 * Time: 14:04
 */

return array(
    // users

    ''=>'main/list',
    'user/register' => 'user/register',
    'user/deleted/([0-9]+)' => 'user/delete/$1',
    'user/update/([0-9]+)' => 'user/update/$1',



);