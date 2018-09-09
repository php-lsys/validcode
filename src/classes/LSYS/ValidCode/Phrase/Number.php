<?php
/**
 * 数字验证码生成器
 */
namespace LSYS\ValidCode\Phrase;
use LSYS\ValidCode\Phrase;
use LSYS\Config;
class Number implements Phrase{
	protected $_length;
	/**
	 * @param Config $config
	 */
	public function __construct(Config $config=null){
		if ($config)$length=$config->get("length");
		if (!isset($length)||$length<=0)$length=6;
		$this->_length=$length;
	}
	/**
	 * {@inheritDoc}
	 * @see \LSYS\ValidCode\Phrase::bulid()
	 */
	public function bulid(){
		$len=intval($this->_length);
		$str='';
		while ($len-->0){
			$str.=rand(0,9);
		}
		return $str;
	}
}