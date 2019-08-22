<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/19 0019
 * Time: 10:57
 */

namespace App\Modules;


use App\Modules\Auth\AuthHandle;
use App\Modules\Role\RoleHandle;

class User
{
    use AuthHandle;
    use RoleHandle;
}