<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security as SecurityCore;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    
    private $userPasswordHasher;
    private $security;
    private $serialise;

    function __construct(UserPasswordHasherInterface $userPasswordHasher, SecurityCore $security, SerializerInterface $serialiser)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->security = $security;
        $this->serialise = $serialiser;
    }
    /**
     * @Route("/api/user", name="app_api_user_show", methods={"GET"})
     */
    function show(UserRepository $userRepository, SerializerInterface $serialiser) {
        $users = $userRepository->findAll();
        $json_affiche = $serialiser->serialize($users, 'json', ["groups"=>"getUser"]);
        return new JsonResponse($json_affiche, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/app/user/showBy", name="app_api_user_email", methods={"GET"})
     * 
     */
    public function showByEmail(UserRepository $userRepository, SerializerInterface $serialise){
         $email = $_GET['email'];
         $data = $userRepository->findBy(["email" => $email]);
         $json_affiche = $serialise->serialize($data, 'json', ["groups"=>["getUser", "getAgent"]]);
         if ($data) {
            return $this->json([
            "status" => "success",
            "data" => json_decode($json_affiche)
        ], 201, []);
         }else {
            return $this->json([
                "status"=>"error",
                "data"=> null,
                "message"=> "Désole, verifier bien votre email!"
            ], 201, []);
         }
         
        
    }

   /**
     * @Route("/api/user", name="app_utilisateur_create", methods={"POST"})
     */
    function create(Request $request, SerializerInterface $serialiser, EntityManagerInterface $em) {
        $json_recu = $request->getContent();
        $utilisateur = $serialiser->deserialize($json_recu, User::class, 'json');
        
        $user = new User();
        $user->setEmail($utilisateur->getEmail());
        $user->setRoles($utilisateur->getRoles());
        $user->setPassword($this->userPasswordHasher->hashPassword($utilisateur, $utilisateur->getPassword()));

        $em->persist($user);
        $em->flush();
        return $this->json("It's ok", 201, []);
    }

    /**
     * @Route("/api/user/get", name="app_utilisateur_get_user", methods={"GET"})
     */
    public function user(SerializerInterface $serialise)
    {
        $user = $this->security->getUser();
        $json_affiche = $serialise->serialize($user, 'json', ["groups"=>["getUser", "getAgent", "getUniteQuartier"]]);
        return new JsonResponse($json_affiche, Response::HTTP_OK, [], true);
    }
}
