#统一校验码生成接口
> 方便验证码生成的统一管理
> 有利于验证码生成代码复用


```
<?php
use LSYS\ValidCode;
require_once  __DIR__."/Bootstarp.php";
$key="login:13510461170";
$vc=\LSYS\ValidCode\DI::get()->valid_code();
$code=$vc->get_code($key);
//自定义
// $mycode=rand(1111,9999);
// $code=$code->set_save_time(3600)->set_code($mycode);
//内部生成
$code_txt=$code
//设置保存时间
->set_save_time(3600)
//保存30秒内创建不变,默认为0 即每次生成不同
->create_code(30)->get_code();
//发送给客户


//客户体检校验码
//获取校验码,与客户提交的进行对比
var_dump($code->get_code());

```