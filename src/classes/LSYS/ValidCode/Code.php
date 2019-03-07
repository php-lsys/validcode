<?php
namespace LSYS\ValidCode;
use LSYS\ValidCode\Phrase\Number;
class Code {
	/**
	 * @var Storage
	 */
	protected $_storage;
	/**
	 * @var Phrase
	 */
	protected $_phrase;
	protected $_save_time=3600;
	protected $_key;
	public function __construct($key,Storage $storage,Phrase $phrase){
		$this->_key=$key;
		$this->_storage=$storage;
		$this->_phrase=$phrase;
	}
	/**
	 * 设置验证码有效时间
	 * @param number $save_time
	 * @return $this
	 */
	public function setSaveTime($save_time=3600){
		$this->_save_time=$save_time;
		return $this;
	}
	/**
	 * 获取验证码有效时间设置
	 * @return number
	 */
	public function getSaveTime(){
		return $this->_save_time;
	}
	/**
	 * 设置一个验证码
	 * @param string $key
	 * @param string $code
	 * @return $this
	 */
	public function setCode($code){
		$this->_storage->set($this->_key,$code,$this->_save_time);
		return $this;
	}
	/**
	 * 创建一个验证码
	 * @param string $key
	 * @param number $duration_time 持续保持不变时间
	 * @param Phrase $code
	 * @return $this
	 */
	public function createCode($duration_time=60,Phrase $phrase=null){
		$key=$this->_key;
		if($this->_storage->isDuration($key,$duration_time)) return $this;
		if ($phrase==null)$phrase=$this->_phrase;
		if ($this->_save_time<$duration_time)$this->_save_time=$duration_time;
		$this->_storage->set($key,$phrase->bulid(),$this->_save_time,$duration_time);
		return $this;
	}
	/**
	 * 获取保存验证码
	 * @param string $key
	 */
	public function getCode(){
		return $this->_storage->get($this->_key);
	}
	/**
	 * 检查验证码是否正确
	 * @param string $code
	 * @return bool
	 */
	public function checkCode($code){
		$_code=$this->_storage->get($this->_key);
		return !(empty($_code)||$_code!=$this->getCode());
	}
	/**
	 * 清除已保存验证码
	 * @param bool
	 */
	public function clearCode(){
		$key=$this->_key;
		return $this->_storage->del($key);
	}
} // End Valid code
