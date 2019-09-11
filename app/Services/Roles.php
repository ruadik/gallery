<?php

namespace App\Services;

final class Roles
{
    const ADMIN = \Delight\Auth\Role::ADMIN;
    const USER = \Delight\Auth\Role::AUTHOR;

    public static function getRoles(){
        return [
                    [
                        'id' => self::ADMIN,
                        'title' => 'Администратор'
                    ],
                    [
                        'id' => self::USER,
                        'title' => 'Пользователь'
                    ]
              ];
    }

    public static function getRole($key)
    {
        foreach (self::getRoles() as $role)
        {
            if($role['id'] == $key){
                return $role['title'];
            }
        }
    }
}