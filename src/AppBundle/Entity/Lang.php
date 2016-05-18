<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "lang")
 */
class Lang
{

	/**
	 * @ORM\Column(type = "string", length=8)
	 * @ORM\Id
	 */
	public $short;

	/**
	 * @ORM\Column(type = "string", length=32)
	 */
	public $lang;

	/**
	 * @return mixed
	 */
	public function getShort()
	{
		return $this->short;
	}

	/**
	 * @param mixed $short
	 */
	public function setShort($short)
	{
		$this->short = $short;
	}

	/**
	 * @return mixed
	 */
	public function getLang()
	{
		return $this->lang;
	}

	/**
	 * @param mixed $lang
	 */
	public function setLang($lang)
	{
		$this->lang = $lang;
	}

	function __toString()
	{
		return $this->lang;
	}


}