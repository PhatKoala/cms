<?php

declare(strict_types=1);

namespace App\Controller\Post;

use App\Annotation\Form;
use App\Entity\Post;
use App\Entity\PostType;
use App\Form\Post\CreateType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/{type}/create", name="post_create", methods={"GET", "POST"})
 * @Form(class=CreateType::class)
 */
class CreateAction extends AbstractController
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PostType $type
     * @param FormInterface<CreateType> $form
     * @return Response
     */
    public function __invoke(PostType $type, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Post $post */
            $post = $form->getData();
            $post->setType($type);

            $this->repository->save($post);

            $this->addFlash('success', sprintf('%s successfully created.', $type->getName()));

            return $this->redirectToRoute('post_edit', [
                'id' => $post->getId(), 'type' => $type
            ]);
        }

        return $this->render('post/create/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
