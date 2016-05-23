<?php
/**
 * Created by PhpStorm.
 * User: tomas
 * Date: 18.5.16
 * Time: 10:56
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "library_user")
 */
class User
{

	/**
	 * @ORM\Column(type="string", length=64)
	 * @ORM\Id
	 */
	public $email;

	/**
	 * @ORM\Column(type="integer", length=8)
	 */
	public $auth;

	/**
	 * @ORM\Column(type="string", length=32)
	 */
	public $name;

	/**
	 * @ORM\Column(type="text")
	 */
	public $googleToken;

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getAuth()
	{
		return $this->auth;
	}

	/**
	 * @param mixed $auth
	 */
	public function setAuth($auth)
	{
		$this->auth = $auth;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getGoogleToken()
	{
		return $this->googleToken;
	}

	/**
	 * @param mixed $googleToken
	 */
	public function setGoogleToken($googleToken)
	{
		$this->googleToken = $googleToken;
	}

}
