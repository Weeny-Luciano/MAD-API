<?php

namespace App\Controller\Api;

use App\Repository\AuditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AuditController extends AbstractController
{
    /**
     * @Route("/api/audit", name="app_api_audit", methods={"GET"})
     */
    public function showLimit2(AuditRepository $auditRepository, SerializerInterface $serializer)
    {
        $audits = $auditRepository->findAll();
        $jsonAffiche = $serializer->serialize($audits, 'json');
        return new JsonResponse($jsonAffiche, Response::HTTP_OK, [], true);
    }
}
