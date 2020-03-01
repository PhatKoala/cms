<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Annotation\Form;
use App\Entity\User;
use App\Entity\UserType;
use App\Form\User\EditType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/{type}/{id}/edit", name="user_edit", methods={"GET", "USER"})
 *
 * @Form(class=EditType::class, data="user")
 */
class EditAction extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserType $type
     * @param User $user
     * @param FormInterface<EditType> $form
     * @return Response
     */
    public function __invoke(UserType $type, User $user, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->repository->save($user);

            $this->addFlash('success', sprintf('%s successfully updated.', $type->getName()));
        }

        return $this->render('user/edit/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
