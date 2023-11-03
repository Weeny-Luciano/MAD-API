<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\Maison;
use App\Repository\MaisonRepository;
use App\Repository\PersonneRepository;
use App\Repository\QuartierRepository;
use App\Repository\TypeMaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MaisonController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison", name="app_api_ville_region_commune_unite_quartier_maison_show", methods={"GET"})
     */
    public function showAll(MaisonRepository $maisonRepository, SerializerInterface $serializer)
    {
        $maisons = $maisonRepository->findAll();
        $jsonAffiche = $serializer->serialize($maisons, 'json', ["groups"=>['getQuartierMaison', 'getQuartierTypeMaison', 'getQuartierPersonne','getUniteQuartier']]);
        return new JsonResponse($jsonAffiche, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison/{lot}", name="app_api_ville_region_commune_unite_quartier_maison_show_lot", methods={"GET"})
     */
    public function showByLot($lot,MaisonRepository $maisonRepository, SerializerInterface $serializer)
    {
        $maison = $maisonRepository->find(["lot_maison"=>$lot]);
        $jsonAffiche = $serializer->serialize($maison, 'json', ["groups"=>['getQuartierMaison', 'getQuartierTypeMaison', 'getQuartierPersonne','getUniteQuartier']]);
        return new JsonResponse($jsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison/in/{quartier}", name="app_api_ville_region_commune_unite_quartier_maison_show_in_quartier", methods={"GET"})
     */
    public function showMaisonInQuartier($quartier,MaisonRepository $maisonRepository, SerializerInterface $serializer)
    {
        $maisons = $maisonRepository->findBy(["quartier"=>$quartier]);
        $jsonAffiche = $serializer->serialize($maisons, 'json', ["groups"=>['getQuartierMaison', 'getQuartierTypeMaison', 'getQuartierPersonne']]);
        return new JsonResponse(json_decode($jsonAffiche), Response::HTTP_OK, []);
    }

    

    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison/addresse/{lot}", name="app_api_ville_region_commune_unite_quartier_maison_show_addresse_lot", methods={"GET"})
     */
    public function showAddresse($lot,MaisonRepository $maisonRepository, SerializerInterface $serializer)
    {
        $maison = $maisonRepository->find(["lot_maison"=>$lot]);
        $quartier = $maison->getQuartier();
        $jsonAffiche = $serializer->serialize($maison, 'json', ["groups"=>['getQuartierMaison', 'getQuartierTypeMaison', 'getQuartierPersonne','getUniteQuartier']]);
        return new JsonResponse([
            "lot"=> $maison->getLotMaison(),
            "parcelle"=> $quartier->getParcelle(),
            "nom_quartier"=> $quartier->getNomQuartier()
        ], Response::HTTP_OK, []);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison/{lot}", name="app_api_ville_region_commune_unite_quartier_maison_delete", methods={"DELETE"})
     */
    public function deleteMaison($lot,MaisonRepository $maisonRepository, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $maison = $maisonRepository->find(["lot_maison"=>$lot]);
        $em->remove($maison);
        $em->flush();
        return new JsonResponse([
            "status"=>"success",
            "message"=>"Maison supprimer"
        ], Response::HTTP_ACCEPTED , []);
    }
    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison", name="app_api_ville_region_commune_unite_quartier_maison_add", methods={"POST"})
     */
    public function addMaison(Request $request, SerializerInterface $serializer,QuartierRepository $quartierRepository, EntityManagerInterface $em, TypeMaisonRepository $typeMaisonRepository, PersonneRepository $personneRepository)
    {
        $jsonRecuperer = $request->getContent();
        $maison = $serializer->deserialize($jsonRecuperer, Maison::class, 'json');
        $array = $request->toArray();
        $type_maison = $array['type_maison'];
        $maison->setTypeMaison($typeMaisonRepository->find($type_maison));
        $proprietaire = $array['proprietaire'];
        $maison->setProprietaire($personneRepository->find(["code_personne"=>$proprietaire]));
        $quartier = $array['quartier'];
        $maison->setQuartier($quartierRepository->find(["code_quartier"=>$quartier]));

        $em->persist($maison);
        $em->flush();

        $jsonAffiche = $serializer->serialize($maison, 'json', ["groups"=>['getQuartierMaison', 'getQuartierTypeMaison', 'getQuartierPersonne','getUniteQuartier']]);
        
        return new JsonResponse([
            "status"=>"success",
            "message"=>"Maison ajouté avec succés",
            "maison"=>json_decode($jsonAffiche)
        ], Response::HTTP_ACCEPTED, []);
    }

    
    /**
     * @Route("/api/ville/region/commune/unite/quartier/maison/{lot}", name="app_api_ville_region_commune_unite_quartier_maison_update", methods={"PUT"})
     */
    public function updateMaison($lot,Request $request, SerializerInterface $serializer,QuartierRepository $quartierRepository, MaisonRepository $maisonRepository,EntityManagerInterface $em, TypeMaisonRepository $typeMaisonRepository, PersonneRepository $personneRepository)
    {

        $maison_old = $maisonRepository->find(["lot_maison"=>$lot]);

        $jsonRecuperer = $request->getContent();
        $maison = $serializer->deserialize($jsonRecuperer, Maison::class, 'json');
        $array = $request->toArray();
        $type_maison = $array['type_maison'];
        $maison->setTypeMaison($typeMaisonRepository->find($type_maison));
        $proprietaire = $array['proprietaire'];
        $maison->setProprietaire($personneRepository->find(["code_personne"=>$proprietaire]));
        $quartier = $array['quartier'];
        $maison->setQuartier($quartierRepository->find(["code_quartier"=>$quartier]));
        $maison_old->setNomMaison($maison->getNomMaison());
        $maison_old->setLotMaison($maison->getLotMaison());
        $maison_old->setAdresseMap($maison->getAdresseMap());
        $maison_old->setNbChambre($maison->getNbChambre());
        $maison_old->setSurface($maison->getSurface());
        $maison_old->setAnneeConstruction($maison->getAnneeConstruction());
        $maison_old->setProprietaire($maison->getProprietaire());
        $maison_old->setTypeMaison($maison->getTypeMaison());
        $maison->setQuartier($maison->getQuartier());


        $em->persist($maison_old);
        $em->flush();

        $jsonAffiche = $serializer->serialize($maison_old, 'json', ["groups"=>['getQuartierMaison', 'getQuartierTypeMaison', 'getQuartierPersonne','getUniteQuartier']]);
        
        return new JsonResponse([
            "status"=>"success",
            "message"=>"Maison modifié avec succés",
            "maison"=>json_decode($jsonAffiche)
        ], Response::HTTP_ACCEPTED, []);
    }

}
