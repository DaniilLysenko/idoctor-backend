<?php

namespace App\Controller\Api;

use App\Repository\AnnouncementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/api")
 */
class AnnouncementController extends AbstractController
{
    /**
     * @Route("/announcements", name="api_announcements", methods={"GET"})
     * @param AnnouncementRepository $announcementRepository
     * @param NormalizerInterface $normalizer
     * @return JsonResponse
     */
    public function announcements(AnnouncementRepository $announcementRepository, NormalizerInterface $normalizer)
    {
        $announcements = $announcementRepository->getAnnouncements();

        return new JsonResponse($normalizer->normalize([
            'announcements' => $announcements
        ]));
    }
}