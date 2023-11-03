<?php

namespace App\Controller\Api\Ville\Region;

use App\Entity\Region;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;



class RegionController extends AbstractController
{
    /**
     * @Route("/api/ville/region", name="app_api_ville_region_show", methods= {"GET"})
     * 
     */
    public function show(RegionRepository $regionRepository, SerializerInterface $serializer) : Response
    {
        $regions = $regionRepository->findAll();
        $JsonRegionList = $serializer->serialize($regions, 'json', ['groups' => ['getRegionCommune','getCommuneUnite','getUniteQuartier']]);
        return new JsonResponse($JsonRegionList, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/ville/region/{id}", name="app_api_ville_region_show_id", methods= {"GET"})
     */
    public function showbyID($id,RegionRepository $regionRepository, SerializerInterface $serializer): Response
    {
        $region = $regionRepository->findBy(["code_region"=>$id]);
        $JsonRegion = $serializer->serialize($region, 'json', ['groups' => ['getRegionCommune','getCommuneUnite','getUniteQuartier']]);
        return new JsonResponse($JsonRegion, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region", name="app_api_ville_region_add", methods= {"POST"})
     */
    public function add(Request $request, EntityManagerInterface $em, SerializerInterface $serializer) 
    {
        $data = $request->getContent();
        $region = $serializer->deserialize($data, Region::class, "json");
        $em->persist($region);
        $em->flush();

        return $this->json($data, 200, []);
    }
}
