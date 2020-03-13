<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\Demographic;

use PhatKoala\UserBundle\Entity\Group;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/{id}/view", name="demographic_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private GroupRepository $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Demographic $type
     * @param Group $demographic
     * @return Response
     */
    public function __invoke(Demographic $type, Group $demographic): Response
    {
        return $this->render('@PhatKoalaUser/demographic/view/index.html.twig', [
            'type' => $type,
            'demographic' => $demographic,
        ]);
    }
}
