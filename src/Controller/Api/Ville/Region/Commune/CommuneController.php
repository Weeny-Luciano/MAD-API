<?php

namespace App\Controller\Api\Ville\Region\Commune;

use App\Entity\Commune;
use App\Repository\CommuneRepository;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommuneController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune", name="app_api_ville_region_commune_show", methods={"GET"})
     */
    public function show(CommuneRepository $communeRepository, SerializerInterface $serializer): Response
    {
        $communes = $communeRepository->findAll();
        $JsonCommuneListe = $serializer->serialize($communes, 'json',['groups' => ['getCommuneUnite','getUniteQuartier']]);
        return new JsonResponse($JsonCommuneListe, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/{id}", name="app_api_ville_region_commune_show_code", methods={"GET"})
     */
    public function showbyID(int $id,CommuneRepository $communeRepository, SerializerInterface $serializer): Response
    {
        $commune = $communeRepository->findBy(["code_commune"=>$id]);
        $JsonCommuneListe = $serializer->serialize($commune, 'json',['groups' => 'getCommuneUnite']);
        return new JsonResponse($JsonCommuneListe, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune", name="app_api_ville_region_commune_add", methods={"POST"})
     */
    public function add(Request $request,RegionRepository $regionRepository, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $commune = $serializer->deserialize($request->getContent(), Commune::class, 'json');
        $JsonRecu = $request->toArray();
        $codeRegion = $JsonRecu['code_region'];

        $commune->setRegion($regionRepository->find(['code_region'=>$codeRegion]));
        $em->persist($commune);
        $em->flush();

        $JSonAffiche = $serializer->serialize($commune, 'json', ['groups' => 'getRegionCommune']);
        return new JsonResponse([
            "status"=>"success",
            "message"=>"Commune ajouté avec succés",
            "commune"=> $JSonAffiche
        ], Response::HTTP_OK, [], true);
    }

}
