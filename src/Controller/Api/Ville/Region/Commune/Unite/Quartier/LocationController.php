<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LocationController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/location", name="app_api_ville_region_commune_unite_quartier_location_show", methods={"GET"})
     */
    public function showAll(LocationRepository $locationRepository, SerializerInterface $serializer)
    {
            $locations = $locationRepository->findAll();
            $json_affiche = $serializer->serialize($locations, 'json', ["groups" => ["getQuartierMenage","getQuartierMaison","getQuartierLocation"]]);
            return new JsonResponse($json_affiche, Response::HTTP_OK, [], true);

    }
    /**
     * @Route("/api/ville/region/commune/unite/quartier/location/menage/maison/{maison}", name="app_api_ville_region_commune_unite_quartier_location_menage_loger", methods={"GET"})
     */
    public function showMenageInLogement($maison,LocationRepository $locationRepository, SerializerInterface $serializer)
    {
            $locations = $locationRepository->findBy(["maison"=>$maison]);
            $json_affiche = $serializer->serialize($locations, 'json', ["groups" => ["getQuartierMenage", "getQuartierPersonne"]]);
            return new JsonResponse($json_affiche, Response::HTTP_OK, [], true);
    }
    /**
     * @Route("/api/ville/region/commune/unite/quartier/location/maison/menage/{menage}", name="app_api_ville_region_commune_unite_quartier_location_maison_loger", methods={"GET"})
     */
    public function showMaisonInLogement($menage,LocationRepository $locationRepository, SerializerInterface $serializer)
    {
            $locations = $locationRepository->findBy(["menage"=>$menage]);
            $json_affiche = $serializer->serialize($locations, 'json', ["groups" => ["getQuartierMaison", "getUniteQuartier"]]);
            return new JsonResponse($json_affiche, Response::HTTP_OK, [], true);
    }
    
}
