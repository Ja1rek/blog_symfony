<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
   /**
   * @var User
   * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
   */

   private $owner;
	
	/**
     * @var Comment[]
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
	protected $comments;

    /**
	* Post constructor
	*/
	
	public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

   /**
   * @return Post[] ArrayCollection
   */
   public function getComments()
    {
        return $this->comments;
    }

    /**
     * add Comment
     * @param Comment $comment
     * @return $this
     */
    public function addComment(Comment $comment)
    {
        $this->comments[]=$comment;

        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *  message="Podaj tytuł"
     * )
	 * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(
     *  message="Podaj treść"
     * )
     * @ORM\Column(name="contens", type="text")
     */
    private $contens;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="date")
     */
    private $dateAdded;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255,columnDefinition="ENUM('Opublikowany', 'Nieopublikowany','Opóźniona') NOT NULL ")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofpublication", type="date")
     */
    private $dateofpublication;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set contens.
     *
     * @param string $contens
     *
     * @return Post
     */
    public function setContens($contens)
    {
        $this->contens = $contens;

        return $this;
    }

    /**
     * Get contens.
     *
     * @return string
     */
    public function getContens()
    {
        return $this->contens;
    }

    /**
     * Set dateAdded.
     *
     * @param \DateTime $dateofpublication
     *
     * @return Post
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded.
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateofpublication.
     *
     * @param \DateTime $dateofpublication
     *
     * @return Post
     */
    public function setDateofpublication($dateofpublication)
    {
        $this->dateofpublication = $dateofpublication;

        return $this;
    }

    /**
     * Get dateofpublication.
     *
     * @return \DateTime
     */
    public function getDateofpublication()
    {
        return $this->dateofpublication;
    }
    /*
    public function __toString()
    {
        return (string) $this->getId();
    }
	*/
	/**
	* @param User $owner
	* @return $this
	*/
	
	
	public function setOwner(User $owner)
    {
        $this->owner = $owner;

        return $this;
    }
	/**
	* @return User
	*/
	
	public function getOwner()
	{
		return $this->owner;
	}
	
	
}
