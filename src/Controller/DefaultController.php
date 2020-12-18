<?php

namespace App\Controller;

use App\Entity\Track;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $dbObjects = $repository->findAll();
        $tracks = $serializer->serialize($dbObjects, 'json');

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($tracks);

        return $response;
    }

    /**
     * @Route("/tracksSorted", name="tracksSorted")
     */
    public function getTracksOrderByField(): Response
    {
        $serializer = $this->get('serializer');
        $repository = $this->getDoctrine()->getRepository(Track::class);
        $dbObjects = $repository
            ->findBy([],
                ['singer' => 'ASC']);
        $tracks = $serializer->serialize($dbObjects, 'json');

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($tracks);

        return $response;
    }
}
