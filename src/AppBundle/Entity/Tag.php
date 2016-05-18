<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "tag")
 */
class Tag
{

	/**
	 * @ORM\Column(type = "string")
	 * @ORM\Id
	 */
	public $tag;

	/**
	 * @return mixed
	 */
	public function getTag()
	{
		return $this->tag;
	}

	/**
	 * @param mixed $tag
	 */
	public function setTag($tag)
	{
		$this->tag = $tag;
	}

	function __toString()
	{
		return $this->tag;
	}

}