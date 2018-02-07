<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Article;

/**
 * Brand controller.
 *
 * @Route("/")
 */
class ArticleController extends Controller
{
    /**
     * Lists all Articles.
     * @FOSRest\Get("/articles")
     *
     * @return array
     */
    public function getArticleAction()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        
        // query for a single Product by its primary key (usually "id")
        $article = $repository->findall();
        
        return View::create($article, Response::HTTP_OK , []);
    }

    /**
     * Create Article.
     * @FOSRest\Post("/article")
     *
     * @return array
     */

    public function postArticleAction(Request $request)
    {
        $article = new Article();
        $article->setName($request->get('name'));
        $article->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return View::create($article, Response::HTTP_CREATED , []);
        
    }
}