<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use App\Repository\PersonneRepository;
use App\Repository\QuartierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\SerializerInterface;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/entreprise", name="app_api_ville_region_commune_unite_quartier_entreprise_show", methods={"GET"})
     */
    public function showAll(EntrepriseRepository $entrepriseRepository, SerializerInterface $serializer)
    {
        $entreprises = $entrepriseRepository->findAll();
        $jsonAffiche = $serializer->serialize($entreprises, 'json', ["groups"=>["getQuartierEntreprise","getQuartierPersonne", 'getUniteQuartier']]);
        return new JsonResponse($jsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/entreprise/{code}", name="app_api_ville_region_commune_unite_quartier_entreprise_show_code", methods={"GET"})
     */
    public function showBycodeEntreprise($code,EntrepriseRepository $entrepriseRepository, SerializerInterface $serializer)
    {
        $entreprise = $entrepriseRepository->find(["code_entreprise"=>$code]);
        $jsonAffiche = $serializer->serialize($entreprise, 'json', ["groups"=>["getQuartierEntreprise","getQuartierPersonne", 'getUniteQuartier']]);
        return new JsonResponse($jsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/entreprise/in/{code}", name="app_api_ville_region_commune_unite_quartier_entreprise_show_in-quartier", methods={"GET"})
     */
    public function showEntrepriseInQuartier($code,EntrepriseRepository $entrepriseRepository, SerializerInterface $serializer)
    {
        $entreprise = $entrepriseRepository->findBy(["quartier"=>$code]);
        $jsonAffiche = $serializer->serialize($entreprise, 'json', ["groups"=>["getQuartierEntreprise","getQuartierPersonne", 'getUniteQuartier']]);
        return new JsonResponse(json_decode($jsonAffiche), Response::HTTP_OK, []);
    }


    /**
     * @Route("/api/ville/region/commune/unite/quartier/entreprise/{code}", name="app_api_ville_region_commune_unite_quartier_entreprise_remove", methods={"DELETE"})
     */
    public function deleteEntreprise($code,EntrepriseRepository $entrepriseRepository, EntityManagerInterface $em,SerializerInterface $serializer)
    {
        $entreprise = $entrepriseRepository->find(["code_entreprise"=>$code]);
        $em->remove($entreprise);
        $em->flush();
        return new JsonResponse([
            "status"=>"success",
            "message"=>"Entreprise supprimé avec succés"
        ], Response::HTTP_ACCEPTED, []);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/entreprise", name="app_api_ville_region_commune_unite_quartier_entreprise_add", methods={"POST"})
     */
    public function addEntreprise(Request $request, SerializerInterface $serializer,QuartierRepository $quartierRepository, PersonneRepository $personneRepository, EntityManagerInterface $em)
    {
        $jsonRecupere = $request->getContent();
        $entreprise = $serializer->deserialize($jsonRecupere, Entreprise::class, 'json');
        $array = $request->toArray();

        $proprietaire = $array["proprietaire"];
        $entreprise->setProprietaire($personneRepository->find(["code_personne"=>$proprietaire]));
        $quartier = $array["quartier"];
        $entreprise->setQuartier($quartierRepository->find(["code_quartier"=>$quartier]));

        $jsonAffiche = $serializer->serialize($entreprise, 'json', ["groups"=>["getQuartierEntreprise","getQuartierPersonne", 'getUniteQuartier']]);
        
        $em->persist($entreprise);
        $em->flush();

        return new JsonResponse([
            "status"=>"success",
            "message"=>"Entreprise ajouté avec succés",
            "entreprise"=>json_decode($jsonAffiche)
        ], Response::HTTP_ACCEPTED, []);
    }
}
