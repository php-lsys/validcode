<?php
use LSYS\ValidCode;

require_once  __DIR__."/Bootstarp.php";
$key="login:13510461170";
$code=\LSYS\ValidCode\DI::get()->valid_code()->get_code($key);

//自定义CODE
// $mycode=rand(1111,9999);
// $code->set_save_time(3600)->set_code($mycode);

//内部生成
$code=$code->set_save_time(3600)->create_code(30);//保存30秒内创建不变

//校验
var_dump(\LSYS\ValidCode\DI::get()->valid_code()->get_code($key)->get_code());

