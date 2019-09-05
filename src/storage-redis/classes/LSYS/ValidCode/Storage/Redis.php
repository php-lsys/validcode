<?php
/**
 * 验证码存储到redis
 */
namespace LSYS\ValidCode\Storage;
use LSYS\ValidCode\Storage;
class Redis implements Storage{
    protected $_prefix;
	protected $_redis;
	/**
	 */
	public function __construct(\LSYS\Redis $redis=null,$prefix='valid_code:'){
	    $this->_redis=$redis?$redis:\LSYS\Redis\DI::get()->redis();
	    $this->_prefix=$prefix;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::set()
	 */
	public function set($key,$code,$save_time,$duration_time=0){
	    $this->_redis->configConnect();
		$key=$this->_prefix.$key;
		$status=$this->_redis->hMset($key,array(
			'code'=>$code,
			'duration'=>time()+$duration_time
		));
		$this->_redis->expire($key,$save_time);
		return $status;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::isDuration()
	 */
	public function isDuration($key){
	    $this->_redis->configConnect();
		$key=$this->_prefix.$key;
		$data=$this->_redis->hGetAll($key);
		if (is_array($data)&&isset($data['duration'])&&$data['duration']>time()) return true;
		return false;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::get()
	 */
	public function get($key){
	    $this->_redis->configConnect();
		$key=$this->_prefix.$key;
		$data=$this->_redis->hGetAll($key);
		if (is_array($data)&&isset($data['code'])) return $data['code'];
		return null;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::del()
	 */
	public function del($key){
	    $this->_redis->configConnect();
		$key=$this->_prefix.$key;
		return $this->_redis->del($key);
	}
}