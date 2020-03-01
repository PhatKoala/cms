<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Annotation\Form;
use App\Entity\UserType;
use App\Form\User\ListType;
use App\Query\UserQuery;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/{type}/list", name="user_list", methods={"GET", "POST"})
 *
 * @Form(class=ListType::class)
 */
class ListAction extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserType $type
     * @param FormInterface<ListType> $form
     * @return Response
     */
    public function __invoke(UserType $type, FormInterface $form): Response
    {
        $query = new UserQuery([
            'type' => (string) $type,
        ]);
//        $query->type()->equal((string) $type);

        $users = $this->repository->query($query);

        return $this->render('user/list/index.html.twig', [
            'type' => $type,
            'users' => $users,
        ]);
    }
}
