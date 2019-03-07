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
	public function set($key,$code,$save_time,$duration_time=0);
	/**
	 * 是否保持不变
	 * @param number $key
	 * @return bool
	 */
	public function isDuration($key);
	/**
	 * 获取验证码
	 * @param string $key
	 */
	public function get($key);
	/**
	 * 移除验证码
	 * @param string $key
	 */
	public function del($key);
}