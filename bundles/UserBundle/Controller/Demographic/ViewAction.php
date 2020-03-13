<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\Demographic;

use PhatKoala\UserBundle\Entity\Segment;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Repository\SegmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/{id}/view", name="demographic_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private SegmentRepository $repository;

    public function __construct(SegmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Demographic $type
     * @param Segment $demographic
     * @return Response
     */
    public function __invoke(Demographic $type, Segment $demographic): Response
    {
        return $this->render('@PhatKoalaUser/demographic/view/index.html.twig', [
            'type' => $type,
            'demographic' => $demographic,
        ]);
    }
}
