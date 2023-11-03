<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite;

use App\Entity\Commune;
use App\Entity\Unite;
use App\Repository\CommuneRepository;
use App\Repository\UniteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UniteController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite", priority=1, name="app_api_ville_region_commune_unite_show", methods={"GET"})
     */
    public function show(UniteRepository $uniteRepository, SerializerInterface $serializer)
    {
        $unites = $uniteRepository->findAll();
        $JsonListeUnite = $serializer->serialize($unites, 'json', ['groups' => ['getCommuneUnite', 'getUniteQuartier']]);
        return new JsonResponse($JsonListeUnite, Response::HTTP_OK, [], true);
    
    }
    /**
     * @Route("/api/ville/region/commune/unite/{id}", name="app_api_ville_region_commune_unite_show_code", methods={"GET"})
     */
    public function showByCode($id,UniteRepository $uniteRepository, SerializerInterface $serializer)
    {
        $unite = $uniteRepository->findBy(["code_unite"=>$id]);
        $JsonUniteListe = $serializer->serialize($unite, 'json', ['groups' => 'getCommuneUnite']);
        return new JsonResponse($JsonUniteListe, Response::HTTP_OK, [], true);
    }
    /**
     * @Route("/api/ville/region/commune/unite", name="app_api_ville_region_commune_unite_add", methods={"POST"})
     */
    public function add(Request $request,EntityManagerInterface $em, SerializerInterface $serializer, CommuneRepository $communeRepository)
    {
        $unites = new Unite;
        $JsonRecu = $request->getContent();
        $unite = $serializer->deserialize($JsonRecu, Unite::class, 'json');

        $JsonContent = $request->toArray();
        $codeCommune = $JsonContent['code_commune'];
       
        
        $unites->setCodeUnite($unite->getCodeUnite());
        $unites->setNomUnite($unite->getNomUnite());
        $unites->setCommune($communeRepository->find(["code_commune"=>$codeCommune]));

        $em->persist($unites);
        $em->flush();
        $jsonAffiche = $serializer->serialize($unites, 'json', ['groups' => 'getCommuneUnite']);

        return new JsonResponse([
            "status"=> "success",
            "message" => "Unité ajouté avec succés",
            "unite" => json_decode($jsonAffiche)
        ], Response::HTTP_CREATED, []);
    }
}
