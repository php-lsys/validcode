<?php
/**
 * 验证码文件存储
 */
namespace LSYS\ValidCode\Storage;
use LSYS\ValidCode\Storage;
use LSYS\Config;
class File implements Storage{
	protected $_dir;
	/**
	 * @param Config $config
	 */
	public function __construct(Config $config=null){
		if ($config) $this->_dir=$config->get("save_dir");
		if(!$this->_dir)$this->_dir=sys_get_temp_dir();
		$this->_dir=rtrim($this->_dir,"\\/").DIRECTORY_SEPARATOR;
	}
	protected function _file($key){
		$file=md5($key);
		$dir=substr($file, 0,6);
		if(!is_dir($this->_dir.$dir))mkdir($this->_dir.$dir);
		return $this->_dir.$dir.DIRECTORY_SEPARATOR.$file.".cvcache";
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::set()
	 */
	public function set($key,$code,$save_time,$duration_time=0){
		$save_time=time()+$save_time;
		$duration_time=time()+$duration_time;
		$file=$this->_file($key);
		$save=implode(":",array($code,$save_time,$duration_time));
		return file_put_contents($file, $save);
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::isDuration()
	 */
	public function isDuration($key){
		$file=$this->_file($key);
		if (!is_file($file)) return false;
		$str=file_get_contents($file);
		$arr=explode(":", $str);
		if (count($arr)!=3) return false;
		list($code,$save_time,$duration_time)=$arr;
		return $duration_time>time();
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::get()
	 */
	public function get($key){
		$file=$this->_file($key);
		if (!is_file($file)) return NULL;
		$str=file_get_contents($file);
		$arr=explode(":", $str);
		if (count($arr)!=3) return false;
		list($code,$save_time,$duration_time)=$arr;
		return $save_time>time()?$code:null;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Storage::get()
	 */
	public function del($key){
		$file=$this->_file($key);
		if (!is_file($file)) return NULL;
		return @unlink($file);
	}
}