<?php
/**
 * lsys lvalidcode[not import]
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
);