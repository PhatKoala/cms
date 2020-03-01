<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Annotation\Form;
use App\Entity\User;
use App\Entity\UserType;
use App\Form\User\CreateType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/{type}/create", name="user_create", methods={"GET", "USER"})
 * @Form(class=CreateType::class)
 */
class CreateAction extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserType $type
     * @param FormInterface<CreateType> $form
     * @return Response
     */
    public function __invoke(UserType $type, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $user->setType($type);

            $this->repository->save($user);

            $this->addFlash('success', sprintf('%s successfully created.', $type->getName()));

            return $this->redirectToRoute('user_edit', ['id' => $user->getId(), 'type' => $type]);
        }

        return $this->render('user/create/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
