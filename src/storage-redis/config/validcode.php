<?php
/**
 * lsys lvalidcode
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
return array(
	"file"=>array(
		'storage'=>\LSYS\ValidCode\Storage\File::class,
		'storage_config'=>array(//文件适配配置
			'cache_dir'=>__DIR__.'/../cache'.DIRECTORY_SEPARATOR,
		),
		'phrase'=>\LSYS\ValidCode\Phrase\Number::class,
		'phrase_config'=>array(//验证码生成配置
			'lenght'=>6
		)
	),
	"redis"=>array(
		'storage'=>\LSYS\ValidCode\Storage\Redis::class,
// 		'storage_config'=>array(
			//默认用系统redis配置
// 		),
	// 不配置CODE 默认用 \LSYS\ValidCode\Phrase\Number
	),
	"memcache"=>array(
		'storage'=>\LSYS\ValidCode\Storage\Memcache::class,
// 		'storage_config'=>array(
			//默认用系统redis配置
// 		),
	// 不配置CODE 默认用 \LSYS\ValidCode\Phrase\Number
	),
		
);