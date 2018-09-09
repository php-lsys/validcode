<?php
namespace LSYS\ValidCode;
use LSYS\Config;
/**
 * 验证码短语生成 
 */
interface Phrase{
	/**
	 * @param Config $config
	 */
	public function __construct(Config $config=null);
	/**
	 * 返回创建验证码
	 * @return string
	 */
	public function bulid();
}