<?php
namespace LSYS;
use LSYS\ValidCode\Code;
use LSYS\ValidCode\Phrase;
use LSYS\ValidCode\Phrase\Number;
use LSYS\ValidCode\Storage;
use LSYS\Config\SubSet;
class ValidCode{
	/**
	 * @var Config
	 */
	protected $_config;
	/**
	 * @var Storage
	 */
	protected $_storage;
	/**
	 * @var Phrase
	 */
	protected $_phrase;
	protected $_save_time=3600;
	public function __construct(Config $config)
	{
	    $storage=$config->get("storage",NULL);
	    if (!class_exists($storage,true)||!in_array(Storage::class,class_implements($storage))){
	        throw new Exception ( strtr('[:storage] storage not implement :interface',array(":storage"=>$storage,":interface"=>Storage::class)));
	    }
	    $storage_config=$config->exist('storage_config')?new SubSet($config, 'storage_config'):NULL;
	    $storage= new $storage($storage_config);
	    $phrase=$config->get("phrase",NULL);
	    if ($phrase!=null&&(!class_exists($phrase,true)||!in_array(Phrase::class,class_implements($phrase)))){
	        throw new Exception ( strtr('[:code] code not implement :interface',array(":code"=>$phrase,":interface"=>Phrase::class)));
	    }
	    if ($phrase!=null){
	        $phrase_config=$config->exist('code_config')?new SubSet($config, 'code_config'):NULL;
	        $phrase= new $phrase($phrase_config);
	    }
		$this->_storage=$storage;
		if ($phrase==null) $phrase= new Number();
		$this->_phrase=$phrase;
		$this->_config=$config;
	}
	/**
	 * code cache
	 * @var array
	 */
	protected $_code=array();
	/**
	 * @param string $key
	 * @return Code
	 */
	public function getCode(string $key){
		$key=strval($key);
		if (!isset($this->_code[$key])){
			$this->_code[$key]=new Code($key, $this->_storage, $this->_phrase);
		}
		return $this->_code[$key];
	}
} // End Valid code
