<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\Quartier;
use App\Repository\QuartierRepository;
use App\Repository\UniteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuartierController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier", priority=1, name="app_api_ville_region_commune_unite_quartier_show", methods={"GET"})
     */
    public function show(QuartierRepository $quartierRepository, SerializerInterface $serializer)
    {
        $quartiers = $quartierRepository->findAll();
        $JsonListeQuartier = $serializer->serialize($quartiers, 'json', ['groups'=> ['getUniteQuartier','getMaisonQuartier','getEntrepriseQuartier']]);
        return new JsonResponse($JsonListeQuartier, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/{id}", name="app_api_ville_region_commune_unite_quartier_show_code", methods={"GET"})
     */
    public function showByID(int $id,QuartierRepository $quartierRepository, SerializerInterface $serializer)
    {
        $quartier = $quartierRepository->find($id);
        $JsonListeQuartier = $serializer->serialize($quartier, 'json', ['groups'=> 'getUniteQuartier']);
        return new JsonResponse($JsonListeQuartier, Response::HTTP_OK, [], true);
    }

    

    /**
     * @Route("/api/ville/region/commune/unite/quartier", name="app_api_ville_region_commune_unite_quartier_add", methods={"POST"})
     */
    public function add(Request $request,UniteRepository $uniteRepository, EntityManagerInterface $em, SerializerInterface $serlializer)
    {

        $jsonRecu = $request->getContent();
        $quartier = $serlializer->deserialize($jsonRecu, Quartier::class, 'json');
        $JsonContent = $request->toArray();
        $code_unite = $JsonContent['code_unite'];
        $quartier->setUnite($uniteRepository->find(["code_unite"=>$code_unite]));

        $em->persist($quartier);
        $em->flush();

        $JsonAffiche = $serlializer->serialize($quartier, 'json', ['groups'=> 'getUniteQuartier']);
        

        return new JsonResponse([
            "status"=>"success",
            "message"=>"Quartier ajouté avec succés",
            "quartier"=>json_decode($JsonAffiche)
        ], Response::HTTP_CREATED, []);
        
    }
    
}

