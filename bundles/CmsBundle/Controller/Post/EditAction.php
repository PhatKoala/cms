<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Post;

use PhatKoala\CoreBundle\Annotation\Form;
use PhatKoala\CmsBundle\Entity\Post;
use PhatKoala\CmsBundle\Entity\PostType;
use PhatKoala\CmsBundle\Form\Post\EditType;
use PhatKoala\CmsBundle\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/{type}/{id}/edit", name="post_edit", methods={"GET", "POST"})
 *
 * @Form(class=EditType::class, data="post")
 */
class EditAction extends AbstractController
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PostType $type
     * @param Post $post
     * @param FormInterface<EditType> $form
     * @return Response
     */
    public function __invoke(PostType $type, Post $post, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $this->repository->save($post);

            $this->addFlash('success', sprintf('%s successfully updated.', $type->getName()));
        }

        return $this->render('post/edit/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
