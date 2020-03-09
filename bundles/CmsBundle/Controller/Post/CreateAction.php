<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Post;

use PhatKoala\CmsBundle\Entity\Post;
use PhatKoala\CmsBundle\Entity\PostType;
use PhatKoala\CmsBundle\Form\Post\CreateType;
use PhatKoala\CmsBundle\Repository\PostRepository;
use PhatKoala\CoreBundle\Annotation\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/{type}/create", name="post_create", methods={"GET", "POST"})
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
     * @return Response
     */
    public function __invoke(PostType $type): Response
    {
        $post = new Post($type);
        $form = $this->createForm(CreateType::class, $post);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->save($post);
            $this->addFlash('success', sprintf('%s successfully created.', $type->getName()));

            return $this->redirectToRoute('post_edit', [
                'id' => $post->getId(), 'type' => $type
            ]);
        }

        return $this->render('@PhatKoalaCms/post/create/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
