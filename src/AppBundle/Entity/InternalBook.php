<?php
/**
 * Created by PhpStorm.
 * User: tomas
 * Date: 18.5.16
 * Time: 12:00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "internal_book")
 */
class InternalBook
{

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;

	/**
	 * @ORM\Column(type="date")
	 */
	public $date;

	/**
	 * @ORM\Column(type="blob")
	 */
	public $book;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @param mixed $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}

	/**
	 * @return mixed
	 */
	public function getBook()
	{
		return $this->book;
	}

	/**
	 * @param mixed $book
	 */
	public function setBook($book)
	{
		$this->book = $book;
	}

}
