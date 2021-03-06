<?php
/**
 * 验证码存储到memcache
 */
namespace LSYS\ValidCode\Storage;
use LSYS\ValidCode\Storage;
class Memcached implements Storage{
	protected $_prefix;
	protected $_mem;
	public function __construct(\LSYS\Memcached $memcache=NULL,$prefix='valid_code:'){
	    $this->_mem=$memcache?$memcache:\LSYS\Memcached\DI::get()->memcached();
	    $this->_prefix=$prefix;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::set()
	 */
	public function set(string $key,string $code,int $save_time,int $duration_time=0):bool{
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		if ($save_time>=2592000)$timeout=time()+$save_time;
		else if ($save_time<=0)$timeout=0;
		else $timeout = $save_time;
		return (bool)$this->_mem->set($key,json_encode(array($code,$duration_time+time())), $timeout);
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::isDuration()
	 */
	public function isDuration(string $key):bool{
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		$data=$this->_mem->get($key);
		if ($data==null) return false;
		$data=json_decode($data,true);
		if (!is_array($data)) return false;
		$duration_time=$data[1]??0;
		if ($duration_time>time()) return true;
		return false;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::get()
	 */
	public function get(string $key){
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		$data=$this->_mem->get($key);
		if ($data==null) return NULL;
		$data=json_decode($data,true);
		if (!is_array($data)) return NULL;
		return array_shift($data);
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::del()
	 */
	public function del(string $key):bool{
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		return (bool) $this->_mem->delete($key);
	}
}