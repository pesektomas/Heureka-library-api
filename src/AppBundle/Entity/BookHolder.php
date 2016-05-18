<?php
/**
 * Created by PhpStorm.
 * User: tomas
 * Date: 18.5.16
 * Time: 10:55
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "book_holders")
 */
class BookHolder
{

	const TYPE_BORROW = "borrow";

	const TYPE_RESERVATION = "reserve";

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $id;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BookUniq")
	 * @ORM\JoinColumn(name="bookUniq", referencedColumnName="code", nullable=true)
	 */
	public $bookUniq;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Book")
	 * @ORM\JoinColumn(name="book", referencedColumnName="book_id", nullable=true)
	 */
	public $book;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
	 * @ORM\JoinColumn(name="holder_user", referencedColumnName="email")
	 */
	public $user;

	/**
	 * @ORM\Column(type="string", length=8)
	 */
	public $type;

	/**
	 * @ORM\Column(name="holder_from", type="datetime")
	 */
	public $from;

	/**
	 * @ORM\Column(name="holder_to", type="datetime", nullable=true)
	 */
	public $to;

	/**
	 * @ORM\Column(type="integer", length=1, nullable=true)
	 */
	public $rate;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	public $rateText;

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
	public function getBookUniq()
	{
		return $this->bookUniq;
	}

	/**
	 * @param mixed $bookUniq
	 */
	public function setBookUniq($bookUniq)
	{
		$this->bookUniq = $bookUniq;
	}

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}

	/**
	 * @return mixed
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getFrom()
	{
		return $this->from;
	}

	/**
	 * @param mixed $from
	 */
	public function setFrom($from)
	{
		$this->from = $from;
	}

	/**
	 * @return mixed
	 */
	public function getTo()
	{
		return $this->to;
	}

	/**
	 * @param mixed $to
	 */
	public function setTo($to)
	{
		$this->to = $to;
	}

	/**
	 * @return mixed
	 */
	public function getRate()
	{
		return $this->rate;
	}

	/**
	 * @param mixed $rate
	 */
	public function setRate($rate)
	{
		$this->rate = $rate;
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
	public function getRateText()
	{
		return $this->rateText;
	}

	/**
	 * @param mixed $rateText
	 */
	public function setRateText($rateText)
	{
		$this->rateText = $rateText;
	}
}
