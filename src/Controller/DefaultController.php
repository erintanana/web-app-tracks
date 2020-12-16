<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/tracks", name="tracks")
     */
    public function getTracks(): Response
    {
        $tracks = [
            [
                'id' => 1,
                'singer' => 'The Kingston Trio',
                'songName' => 'Tom Dooley',
                'genre' => 'Folk',
                'year' => 1958
            ],
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent(json_encode($tracks));

        return $response;
    }
}
