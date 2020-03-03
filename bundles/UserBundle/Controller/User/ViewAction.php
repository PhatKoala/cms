<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\User;

use PhatKoala\UserBundle\Entity\User;
use PhatKoala\UserBundle\Entity\UserType;
use PhatKoala\UserBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/{type}/{id}/view", name="user_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserType $type
     * @param User $user
     * @return Response
     */
    public function __invoke(UserType $type, User $user): Response
    {
        return $this->render('@PhatKoalaUser/user/view/index.html.twig', [
            'type' => $type,
            'user' => $user,
        ]);
    }
}
