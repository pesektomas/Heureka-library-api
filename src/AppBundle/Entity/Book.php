<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "book")
 */
class Book
{

	/**
	"book_id": "1",
	"name": "Zend framework in action",
	"detail_link": "https://google.com",
	"lang": "en",
	"form": "paper",
	"tags": [
	"Vývoj",
	"Marketing"
	],
	"total": 3,
	"available": [
	{
	"place": "praha",
	"quantity": 1
	},
	{
	"place": "liberec",
	"quantity": 0
	}
	],
	"holders": [
	{
	"user": "Tomas Pesek",
	"from": "2016-04-01"
	},
	{
	"user": "Pokusny Kralik",
	"from": "2016-04-04"
	}
	]
	 */

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $bookId;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	public $name;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	public $detailLink;

	/**
	 * @ORM\Column(type="blob", nullable=true)
	 */
	public $image;

	/**
	 * @ORM\Column(type="blob", nullable=true)
	 */
	public $book;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lang")
	 * @ORM\JoinColumn(name="lang", referencedColumnName="short")
	 */
	public $lang;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Form")
	 * @ORM\JoinColumn(name="form", referencedColumnName="short")
	 */
	public $form;

	/**
	 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tag")
	 * @ORM\JoinTable(name="book_to_tag",
	 *      joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="book_id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="tag", referencedColumnName="tag")}
	 *      )
	 */
	public $tags;

	/**
	 * @return mixed
	 */
	public function getBookId()
	{
		return $this->bookId;
	}

	/**
	 * @param mixed $bookId
	 */
	public function setBookId($bookId)
	{
		$this->bookId = $bookId;
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
	public function getDetailLink()
	{
		return $this->detailLink;
	}

	/**
	 * @param mixed $detailLink
	 */
	public function setDetailLink($detailLink)
	{
		$this->detailLink = $detailLink;
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

	/**
	 * @return mixed
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * @param mixed $tags
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	}

	/**
	 * @return mixed
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param mixed $image
	 */
	public function setImage($image)
	{
		$this->image = $image;
	}

	function __toString()
	{
		return $this->name;
	}


}