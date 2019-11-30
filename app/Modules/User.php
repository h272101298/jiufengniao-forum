<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/19 0019
 * Time: 10:57
 */

namespace App\Modules;


use App\Modules\Auth\AuthHandle;
use App\Modules\BetUser\BetUserHandle;
use App\Modules\Manager\ManagerHandle;
use App\Modules\Ranking\RankingHandle;
use App\Modules\Record\RecordHandle;
use App\Modules\Results\ResulesHandle;
use App\Modules\Results\ResultsHandle;
use App\Modules\Role\RoleHandle;

class User
{
    use AuthHandle;
    use RoleHandle;
    use BetUserHandle;
    use RankingHandle;
    use ResultsHandle;
    use RecordHandle;
    use ManagerHandle;
}
