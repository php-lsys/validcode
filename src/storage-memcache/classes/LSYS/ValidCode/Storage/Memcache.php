<?php
/**
 * 验证码存储到memcache
 */
namespace LSYS\ValidCode\Storage;
use LSYS\ValidCode\Storage;
class Memcache implements Storage{
	protected $_prefix;
	protected $_mem;
	public function __construct(\LSYS\Memcache $memcache=NULL,$prefix='valid_code:'){
	    $this->_mem=$memcache?$memcache:\LSYS\Memcache\DI::get()->memcache();
	    $this->_prefix=$prefix;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::set()
	 */
	public function set($key,$code,$save_time,$duration_time=0){
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		if ($save_time>=2592000)$timeout=time()+$save_time;
		else if ($save_time<=0)$timeout=0;
		else $timeout = $save_time;
		return $this->_mem->set($key,json_encode(array($code,$duration_time+time())),false, $timeout);
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::isDuration()
	 */
	public function isDuration($key){
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		$data=$this->_mem->get($key);
		if ($data==null) return false;
		$data=json_decode($data,true);
		if (!is_array($data)) return false;
		list($code,$duration_time)=$data;
		if ($duration_time>time()) return true;
		return false;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::get()
	 */
	public function get($key){
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
	public function del($key){
	    $this->_mem->configServers();
		$key=$this->_prefix.$key;
		return $this->_mem->delete($key);
	}
}