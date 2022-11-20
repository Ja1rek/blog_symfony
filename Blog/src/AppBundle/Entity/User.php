<?php



namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Post[]\ArrayColletion
     * @ORM\OneToMany(targetEntity="Post", mappedBy="owner")
     *  @ORM\JoinColumn(name="owner_id",referencedColumnName="id")
     */
	private $posts;
    /*
     * User Constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->posts= new ArrayCollection();
    }

    /**
     * @return Post[] ArrayCollection
     */

    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post $post
     * @return $this
     */

    public function addPost(Post $post)
    {
        $this->posts[]=$post;
        return $this;
    }




}