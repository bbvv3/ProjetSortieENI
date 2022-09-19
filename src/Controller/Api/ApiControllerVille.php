<?php

namespace App\Controller\Api;

use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api")
 */
class ApiControllerVille extends AbstractController
{
    /**
     * @Route("/ville",name="api_list_ville", methods={"GET"})
     *
     */
    public function villeCodePostal(VilleRepository $villeRepository):JsonResponse
    {
        $codePostal=$villeRepository->findAll();
        return $this->json($codePostal,Response::HTTP_OK,[]);
    }
}