<?php

namespace App\Controller;

use App\Entity\Track;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toJSON;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/tracks", name="tracks")
     */
    public function getTracks(): Response
    {
        $serializer = $this->get('serializer');
        $repository = $this->getDoctrine()->getRepository(Track::class);
        $tracks = $serializer->serialize($repository->findAll(), 'json');

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($tracks);

        return $response;
    }
}
