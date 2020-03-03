<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\Demographic;

use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Entity\DemographicType;
use PhatKoala\UserBundle\Repository\DemographicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/{id}/view", name="demographic_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private DemographicRepository $repository;

    public function __construct(DemographicRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param DemographicType $type
     * @param Demographic $demographic
     * @return Response
     */
    public function __invoke(DemographicType $type, Demographic $demographic): Response
    {
        return $this->render('@PhatKoalaUser/demographic/view/index.html.twig', [
            'type' => $type,
            'demographic' => $demographic,
        ]);
    }
}
