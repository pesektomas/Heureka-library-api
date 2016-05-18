<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "form")
 */
class Form
{

	/**
	 * @ORM\Column(type = "string", length=8)
	 * @ORM\Id
	 */
	public $short;

	/**
	 * @ORM\Column(type = "string", length=32)
	 */
	public $form;

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
	public function getForm()
	{
		return $this->form;
	}

	/**
	 * @param mixed $form
	 */
	public function setForm($form)
	{
		$this->form = $form;
	}

	function __toString()
	{
		return $this->form;
	}

}
