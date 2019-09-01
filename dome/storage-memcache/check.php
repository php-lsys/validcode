<?php
require_once  __DIR__."/Bootstarp.php";
\LSYS\ValidCode\DI::$config="validcode.memcache";
$key="login:13510461170";
$code=\LSYS\ValidCode\DI::get()->validCode()->getCode($key);

//自定义CODE
// $mycode=rand(1111,9999);
// $code->setSaveTime(3600)->setCode($mycode);

//内部生成
$code=$code->setSaveTime(3600)->createCode(30);//保存30秒内创建不变

//校验
var_dump(\LSYS\ValidCode\DI::get()->validCode()->getCode($key)->getCode());

