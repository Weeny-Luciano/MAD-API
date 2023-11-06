<?php

namespace App\Controller\Api\Ville\Region\Commune\Unite\Quartier;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Exception\ExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class PersonneController extends AbstractController
{
    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne", name="app_api_ville_region_commune_unite_quartier_personne_show", methods={"GET"})
     */
    public function showAll(PersonneRepository $personneRepository, SerializerInterface $serialize)
    {
        $personnes = $personneRepository->findAll();
        $JsonAffiche = $serialize->serialize($personnes, 'json',['groups'=> 'getQuartierPersonne']);

        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/children/{parent}", name="app_api_ville_region_commune_unite_quartier_personne_children", methods={"GET"})
     */
    public function showChildren($parent,PersonneRepository $personneRepository, SerializerInterface $serialize)
    {
        $personnes= $personneRepository->findBy(["pere_personne"=>$parent]);
        $JsonAffiche = $serialize->serialize($personnes, 'json',['groups'=> 'getQuartierPersonne']);
        return new JsonResponse($JsonAffiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/parent/{children}", name="app_api_ville_region_commune_unite_quartier_personne_parent", methods={"GET"})
     */
    public function showParent($children,PersonneRepository $personneRepository, SerializerInterface $serialize)
    {
        $personnes= $personneRepository->find($children);

        $pere = $personnes->getPerePersonne();
        $mere = $personnes->getMerePersonne(); 
        $JsonPere = $serialize->serialize($pere, 'json',['groups'=> 'getQuartierPersonne']);
        $JsonMere = $serialize->serialize($mere, 'json',['groups'=> 'getQuartierPersonne']);
        return new JsonResponse(["pere"=>json_decode($JsonPere),"mere"=>json_decode($JsonMere)], Response::HTTP_OK, []);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/{id}", name="app_api_ville_region_commune_unite_quartier_personne_id", methods={"GET"})
     */
    public function showId($id,PersonneRepository $personneRepository, SerializerInterface $serialize)
    {
        $personnes= $personneRepository->find($id);
        $JsonId = $serialize->serialize($personnes, 'json',['groups'=> 'getQuartierPersonne']);
        return new JsonResponse(json_decode($JsonId), Response::HTTP_OK, []);
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/{nom}/{prenom}", name="app_api_ville_region_commune_unite_quartier_personne_nom_prenom", methods={"GET"})
     */
    public function showNomPrenom($nom,$prenom,PersonneRepository $personneRepository, SerializerInterface $serialize)
    {
        $personnes= $personneRepository->findBy(["nom_personne"=>$nom, "prenom_personne"=>$prenom]);
        $JsonId = $serialize->serialize($personnes, 'json',['groups'=> 'getQuartierPersonne']);
        return new JsonResponse(json_decode($JsonId), Response::HTTP_OK, []);
    }
    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/{id}", name="app_api_ville_region_commune_unite_quartier_personne_delete", methods={"DELETE"})
     */
    public function deletePersonne($id,PersonneRepository $personneRepository, SerializerInterface $serialize,EntityManagerInterface $em)
    {
        try {
            $personne= $personneRepository->find($id);
            $em->remove($personne);
            $em->flush();
            return new JsonResponse([
                "status"=> "succes",
                "message"=> "Personne supprimé avec succés"
            ]
            , Response::HTTP_ACCEPTED, []);
        } catch (Exception $th) {
            return new JsonResponse([
                "status"=> "error",
                "message"=> "Erreur de suppression"
            ], Response::HTTP_BAD_REQUEST);
        }
        
    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne", name="app_api_ville_region_commune_unite_quartier_personne_add", methods={"POST"})
     */
    public function addPersonne(Request $request,SerializerInterface $serializer, PersonneRepository $personneRepository, EntityManagerInterface $em)
    {
        $personne = $serializer->deserialize($request->getContent(), Personne::class, 'json');
        $ArrayRecupere = $request->toArray();
        $PerePersonne = $ArrayRecupere["pere_personne"];
        $MerePersonne = $ArrayRecupere["mere_personne"];

        $personne->setPerePersonne($personneRepository->find(["code_personne"=>$PerePersonne]));
        $personne->setMerePersonne($personneRepository->find(["code_personne"=>$MerePersonne]));

        $em->persist($personne);
        $em->flush();

        $JsonAffiche = $serializer->serialize($personne, 'json', ['groups'=> 'getQuartierPersonne'] );

        return new JsonResponse([
            "status"=> "succes",
            "message"=> "Personne ajouté avec succés",
            "personne"=> json_decode($JsonAffiche)
        ]
        , Response::HTTP_ACCEPTED, []);

    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/{id}", name="app_api_ville_region_commune_unite_quartier_personne_update", methods={"PUT"})
     */
    public function updatePersonne($id,Request $request,SerializerInterface $serializer, PersonneRepository $personneRepository, EntityManagerInterface $em)
    {
        $personne_old = $personneRepository->find($id);
        $personne_new = $serializer->deserialize($request->getContent(), Personne::class, 'json');
        $ArrayRecupere = $request->toArray();
        $PerePersonne = $ArrayRecupere["pere_personne"];
        $MerePersonne = $ArrayRecupere["mere_personne"];

        $personne_new->setPerePersonne($personneRepository->find(["code_personne"=>$PerePersonne]));
        $personne_new->setMerePersonne($personneRepository->find(["code_personne"=>$MerePersonne]));

        $personne_old->setNomPersonne($personne_new->getNomPersonne());
        $personne_old->setPrenomPersonne($personne_new->getPrenomPersonne());
        $personne_old->setDateNaissance($personne_new->getDateNaissance());
        $personne_old->setSexe($personne_new->getSexe());
        $personne_old->setCodePersonne($personne_new->getCodePersonne());
        $personne_old->setPerePersonne($personne_new->getPerePersonne());
        $personne_old->setMerePersonne($personne_new->getMerePersonne());

        $em->persist($personne_old);
        $em->flush();
        

        $JsonAffiche = $serializer->serialize($personne_old, 'json', ['groups'=> 'getQuartierPersonne'] );

        return new JsonResponse([
            "status"=> "succes",
            "message"=> "Personne modifié avec succés",
            "personne"=> json_decode($JsonAffiche)
        ]
        , Response::HTTP_ACCEPTED, []);

    }

    /**
     * @Route("/api/ville/region/commune/unite/quartier/personne/in/personne/{code}", name="personne_in_quartier", methods={"GET"})
     */
    public function showPersonneQuartier($code,PersonneRepository $personneRepository, SerializerInterface $serialize)
    {
        $personnes = $personneRepository->findByExampleField($code);
        
        $JsonAffiche = $serialize->serialize($personnes, 'json',['groups'=> 'getQuartierPersonne']);
        return new JsonResponse(
            $JsonAffiche,
            Response::HTTP_OK,
            [],
            true
        );
    }


}
