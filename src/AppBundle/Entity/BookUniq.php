<?php
/**
 * Created by PhpStorm.
 * User: tomas
 * Date: 17.5.16
 * Time: 21:16
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "book_uniq")
 */
class BookUniq
{

	/**
	 * @ORM\Column(type = "string")
	 * @ORM\Id
	 */
	public $code;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
	 * @ORM\JoinColumn(name="book_id", referencedColumnName="book_id")
	 */
	public $book;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Locality")
	 */
	private $locality;

	/**
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param mixed $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
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

	/**
	 * @return mixed
	 */
	public function getLocality()
	{
		return $this->locality;
	}

	/**
	 * @param mixed $locality
	 */
	public function setLocality($locality)
	{
		$this->locality = $locality;
	}

}