<?php
/**
 * lsys lvalidcode
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
return array(
	"memcache"=>array(
		'storage'=>\LSYS\ValidCode\Storage\Memcache::class,
// 		'storage_config'=>array(
			//默认用系统redis配置
// 		),
	// 不配置CODE 默认用 \LSYS\ValidCode\Phrase\Number
	),
);