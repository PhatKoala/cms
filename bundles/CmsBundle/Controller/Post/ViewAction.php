<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Post;

use PhatKoala\CmsBundle\Entity\Post;
use PhatKoala\CmsBundle\Entity\PostType;
use PhatKoala\CmsBundle\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/{type}/{id}/view", name="post_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PostType $type
     * @param Post $post
     * @return Response
     */
    public function __invoke(PostType $type, Post $post): Response
    {
        return $this->render('post/view/index.html.twig', [
            'type' => $type,
            'post' => $post,
        ]);
    }
}
