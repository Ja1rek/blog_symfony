<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;
    /**
	*
	*@return Post
	*/

    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param $post
     * @return $this
     */
     
	public function setPost( $post)
    {
        $this->post = $post;

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
     * @Assert\NotBlank(
	 *  message="Podaj autora"
	 * )
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string
     * @Assert\NotBlank(
     *  message="Podaj email"
     * )
     * @Assert\Email(
     *     message = "The email '{{ value }}' to nie jest email.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateadded", type="date")
     */
    private $dateadded;

    /**
     * @var string
     * @Assert\NotBlank(
     *  message="Podaj treść"
     * )
	 *
     * @ORM\Column(name="contents", type="text")
     */
    private $contents;


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
     * Set author.
     *
     * @param string $author
     *
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateadded.
     *
     * @param \DateTime $dateadded
     *
     * @return Comment
     */
    public function setDateadded($dateadded)
    {
        $this->dateadded = $dateadded;

        return $this;
    }

    /**
     * Get dateadded.
     *
     * @return \DateTime
     */
    public function getDateadded()
    {
        return $this->dateadded;
    }

    /**
     * Set contents.
     *
     * @param string $contents
     *
     * @return Comment
     */
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Get contents.
     *
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }


}
