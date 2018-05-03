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
class UserController extends Controller
{
    /**
     * Create Client.
     * @FOSRest\Get("/createClient")
     *
     * @return array
     */
    public function AuthenticationAction()
    {
        
        
                // Get the client manager
                /** @var ClientManagerInterface $clientManager */
                $clientManager = $this->get('fos_oauth_server.client_manager.default');
        
                // Create a new client
                $client = $clientManager->createClient();
        
                $client->setRedirectUris($input->getOption('redirect-uri'));
                $client->setAllowedGrantTypes($input->getOption('grant-type'));
        
                // Save the client
                $clientManager->updateClient($client);
        
                // Give the credentials back to the user
                $headers = ['Client ID', 'Client Secret'];
                $rows = [
                    [$client->getPublicId(), $client->getSecret()],
                ];
        
        dump($rows);exit;
        return View::create($rows, Response::HTTP_OK , []);
    }

}