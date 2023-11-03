<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\TypeMaison;
use App\Repository\TypeMaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TypeMaisonController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/type/maison", name="app_api_ville_region_commune_unite_quartier_type_maison_show", methods={"GET"})
     */
    public function showAll(TypeMaisonRepository $typeMaisonRepository, SerializerInterface $serializer)
    {
        $types = $typeMaisonRepository->findAll();
        $json = $serializer->serialize($types, 'json', ["groups"=>"getQuartierTypeMaison"]);
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/type/maison", name="app_api_ville_region_commune_unite_quartier_type_maison_add", methods={"POST"})
     */
    public function addType(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $jsonRecuperer = $request->getContent();
        $type = $serializer->deserialize($jsonRecuperer, TypeMaison::class, 'json');
        $em->persist($type);
        $em->flush();
        return new JsonResponse([
            "status"=>"success",
            "message"=>"Type maison ajouter",
            "type"=>json_decode($jsonRecuperer)
        ]);
    }
}
