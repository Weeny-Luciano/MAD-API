<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\MembreMenage;
use App\Repository\MembreMenageRepository;
use App\Repository\MenageRepository;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MembreMenageController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/membre/menage", name="app_api_ville_region_commune_unite_quartier_membre_menage_show", methods={"GET"})
     */
    public function showMembre(MembreMenageRepository $membreMenageRepository, SerializerInterface $serializer)
    {
        $membreMenages = $membreMenageRepository->findAll();
        $JsonAffiche = $serializer->serialize($membreMenages, 'json',  ['groups'=> ['getQuartierMembre','getQuartierPersonne', 'getQuartierMenage']]);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/membre/personne/menage/{menage}", name="app_api_ville_region_commune_unite_quartier_membre_menage_show_personne", methods={"GET"})
     */
    public function showPersonneInMenage($menage,MembreMenageRepository $membreMenageRepository, SerializerInterface $serializer)
    {
        $membreMenages = $membreMenageRepository->findBy(["menage"=>$menage]);
        $JsonAffiche = $serializer->serialize($membreMenages, 'json',  ['groups'=> 'getQuartierPersonne']);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/membre/menage/personne/{personne}", name="app_api_ville_region_commune_unite_quartier_membre_menage_personne_personne", methods={"GET"})
     */
    public function showMenageOfPersonne($personne,MembreMenageRepository $membreMenageRepository, SerializerInterface $serializer)
    {
        $membreMenages = $membreMenageRepository->findBy(["personne"=>$personne]);
        $JsonAffiche = $serializer->serialize($membreMenages, 'json',  ['groups'=> 'getQuartierMenage']);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }
    /**
     * @Route("/api/ville/region/commune/unite/quartier/membre/menage", name="app_api_ville_region_commune_unite_quartier_membre_menage_add", methods={"POST"})
     */
    public function addMembre(Request $request,EntityManagerInterface $em,MembreMenageRepository $membreMenageRepository,MenageRepository $menageRepository, PersonneRepository $personneRepository,  SerializerInterface $serializer)
    {
        $json_recuperer = $request->getContent();
        $membre = $serializer->deserialize($json_recuperer, MembreMenage::class, 'json');
        $array = $request->toArray();
        $code_personne = $array["code_personne"];
        $code_menage = $array["code_menage"];

        $personne = $personneRepository->find(["code_personne"=>$code_personne]);
        $menage = $menageRepository->find(["code_menage"=>$code_menage]);

        $membre->setPersonne($personne);
        $membre->setMenage($menage);

        $em->persist($membre);
        $em->flush();

        
        $JsonAffiche = $serializer->serialize($membre, 'json',  ['groups'=> ['getQuartierMembre','getQuartierPersonne', 'getQuartierMenage']]);
        return new JsonResponse([
            "status"=> "succes",
            "message"=> "Personne ajouté dans menage",
            "membre_menage"=> json_decode($JsonAffiche)
        ], Response::HTTP_ACCEPTED, []);
    }
}
