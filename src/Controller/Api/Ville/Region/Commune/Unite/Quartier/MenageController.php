<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\Menage;
use App\Repository\MenageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MenageController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/menage", name="app_api_ville_region_commune_unite_quartier_menage_show", methods={"GET"})
     */
    public function showMenage(MenageRepository $menageRepository, SerializerInterface $serializer): Response
    {
        $menages = $menageRepository->findAll();
        $JsonAffiche = $serializer->serialize($menages, 'json', ['groups'=> 'getQuartierMenage']);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/menage/{id}", name="app_api_ville_region_commune_unite_quartier_menage_show_id", methods={"GET"})
     */
    public function showIdMenage($id,MenageRepository $menageRepository, SerializerInterface $serializer): Response
    {
        $menages = $menageRepository->find(["code_menage"=>$id]);
        $JsonAffiche = $serializer->serialize($menages, 'json', ['groups'=> ['getQuartierMenage']]);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/menage/in/quartier/{id}", name="app_api_ville_region_commune_unite_quartier_menage_show_menage_in_quartier", methods={"GET"})
     */
    public function showMenageInQuartier($id,MenageRepository $menageRepository, SerializerInterface $serializer): Response
    {
        $menages = $menageRepository->findByMenageInQuartier($id);
        $JsonAffiche = $serializer->serialize($menages, 'json', ['groups'=> 'getQuartierMenage']);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }
    /**
     * @Route("/api/ville/region/commune/unite/quartier/menage", name="app_api_ville_region_commune_unite_quartier_menage_add", methods={"POST"})
     */
    public function addMenage(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): Response
    {
        $json_recuperer = $request->getContent();
        $menage = $serializer->deserialize($json_recuperer, Menage::class, 'json');

        $em->persist($menage);
        $em->flush();
        $JsonAffiche = $serializer->serialize($menage, 'json', ['groups'=> 'getQuartierMenage']);
        return new JsonResponse([
            "status"=>"succes",
            "message"=> "Menage ajouté",
            "menage"=>json_decode($JsonAffiche)
        ], Response::HTTP_ACCEPTED, []);
    }

}
