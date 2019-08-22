<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker=\Faker\Factory::create('zh_CN');//初始化faker

        //循环生成数据
        /* $data=[];
        for ($i=0;$i<10;$i++){
             $data[]=[
                 'username'=> $faker->userName,//生成用户名
                 'password'=> bcrypt('123456'),//使用laravel里内置的bcrypt方法加密密码
                 'mobile'=> $faker->phoneNumber,//生成手机号
                 'role_id'=>rand(1,6),//随机角色id
                 'status'=>rand(1,2),//随机状态
                 'created_at'=>date('Y-m-d H:i:s',time())
             ];
         }*/
        //生成一条数据
        $line=[
            'username'=> 'admin',//生成用户名
            'password'=> bcrypt('123456'),//使用laravel里内置的bcrypt方法加密密码
            //'mobile'=> $faker->phoneNumber,//生成手机号
            'last_login_ip'=>'127.0.0.1',
            'last_login_time'=>time(),
            'role_id'=>rand(1,6),//随机角色id
            'status'=>rand(1,2),//随机状态
            'created_at'=>date('Y-m-d H:i:s',time())
        ];
        //写入数据库
        DB::table('users')->insert($line);


    }
}
