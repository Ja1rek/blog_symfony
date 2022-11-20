<?php
/**
 * Created by PhpStorm.
 * User: Jarek
 * Date: 2018-12-22
 * Time: 19:56
 */

namespace AppBundle\Controller;
use AppBundle\Form\CommentType;
use AppBundle\Form\PostType;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Entity\User;

//use http\Env\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogControler extends Controller
{
    /**
     * @Route("/blog/",name="blog_index")
     * @return Response
     */

    public function indexBlog(Request $request)
    {

        $paginator  = $this->get('knp_paginator');

       $em = $this->getDoctrine()->getManager();
       $posts=$em->getRepository(Post::class)->findBy(['status'=>'Opublikowany'],array('dateofpublication'=>'DESC'));

       $result=$paginator->paginate(
            $posts,
            $request->query->getint('page',1),
            $request->query->getint('limit',5)

        );

        return $this->render("Blog/index.html.twig",['posts'=>$result,]);

    }
    
	 
	
    
	
	
	
	
	
	
	
	/**
     * @Route("/blog/{id}",name="blog_details")
     * @param $id
     */
	
    public function detailsAction($id,Request $request,Post $post)
    {
        
        $paginator  = $this->get('knp_paginator');
        $post = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->find($id);

        $details = $post->getComments();
        $result=$paginator->paginate(
            $details,
            $request->query->getint('page',1),
            $request->query->getint('limit',5)

        );


        $comment= new Comment();
        $comment
            ->setPost($post)
			->setDateadded(new\DateTime());

        $form = $this->createForm(CommentType::Class,$comment);
        $form->handleRequest($request);
            
        
           
		   if( $form->isValid() )
			{
				$em = $this->getDoctrine()->getManager();
				$em->persist($comment);
				$em->flush();
				$this->addFlash("success","Dodano komentarz");
				

			}
		   
		  
      
       
        return $this->render("Blog/details.html.twig",['post'=>$post,'details'=>$result,'form'   =>   $form->createView()]);
		 
		 
    }

    

    /**
     * @Route("/blog/admin/addpost",name="blog_addpost")
     * 
	 * @return Response
     */
    public function addpostAction(Request $request)
    {	$this->denyAccessUnlessGranted('ROLE_USER');
       
	   
		$Post= new Post();
        $Post
		->setDateadded(new\DateTime())
		->setDateofpublication(new\DateTime())
		->setOwner($this->getUser());
		$form = $this->createForm(PostType::Class,$Post);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid())
		{
			
			  
			
				$em = $this->getDoctrine()->getManager();
				$em->persist($Post);
				$em->flush();
				$this->addFlash("success","Dodano Post");
				return $this->redirectToRoute('blog_details', array(
                'id' => $Post->getId(),
			    ));
			
		}
       
	   return $this->render("Blog/postadd.html.twig", [
            'form'   =>   $form->createView()]);
    }
	/**
     * @Route("/blog/admin/editpost/{id}",name="blog_editpost")
     * @param Request $request
	 * @param Post $post
	 * @return Response
     */
	
	public function editpostAction(Request $request,Post $post)
	{   $this->denyAccessUnlessGranted('ROLE_USER');
		if($this->getUser() != $post->getOwner())
		{
			throw new AccessDeniedException();
		}
		
		$form = $this->createForm(PostType::Class,$post);
        
		if($request->isMethod("post"))
		{
			$form->handleRequest($request);
			 
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($post);
			$em->flush();
			$this->addFlash("success","Edytowno Post");
			return $this->redirectToRoute('blog_details', array(
            'id' => $post->getId(),
            ));
		}
		
		 return $this->render("Blog/editpost.html.twig", [
            'form'   =>   $form->createView()]);
    }
	
    
	

   


   /**
     * @Route("/blog/admin/admin",name="blog_adm")
	 * @param Request $request
	 * 
	 * @return Response
     */
	 
    public function adminAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
		
		$paginator  = $this->get('knp_paginator');

        $em = $this->getDoctrine()->getManager();
        $posts=$em->getRepository(Post::class)->findAll();

        $result=$paginator->paginate(
            $posts,
            $request->query->getint('page',1),
            $request->query->getint('limit',5)

        );



        return $this->render("Blog/adm.html.twig",['posts'=>$result,]);
    }

}


