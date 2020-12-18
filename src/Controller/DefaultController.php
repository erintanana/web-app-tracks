<?php

namespace App\Controller;

use App\Entity\Track;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/tracks/{filter}", name="tracks")
     * @param Request $request
     * @param null $filter
     * @return Response
     */
    public function getTracks(Request $request, $filter = null): Response
    {
        $serializer = $this->get('serializer');
        $repository = $this->getDoctrine()->getRepository(Track::class);
        $dbObjects = $repository->findBy([],
            [
                'singer' => 'desc'
            ]);
        $tracks = $serializer->serialize($dbObjects, 'json');

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($tracks);

        return $response;
    }

}
