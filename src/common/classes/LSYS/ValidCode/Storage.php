<?php
namespace LSYS\ValidCode;
use LSYS\Config;

interface Storage{
	/**
	 * @param Config $config
	 */
	public function __construct(Config $config=null);
	/**
	 * 保持验证码
	 * @param string $key
	 * @param string $code 验证码
	 * @param number $save_time 保持时间
	 * @param number $duration_time 保持不变时间
	 * @return bool
	 */
	public function set(string $key,string $code,int $save_time,int $duration_time=0):bool;
	/**
	 * 是否保持不变
	 * @param number $key
	 * @return bool
	 */
	public function isDuration(string $key):bool;
	/**
	 * 获取验证码
	 * @param string $key
	 */
	public function get(string $key);
	/**
	 * 移除验证码
	 * @param string $key
	 */
	public function del(string $key):bool;
}