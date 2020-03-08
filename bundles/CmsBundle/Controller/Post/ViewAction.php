<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Post;

use PhatKoala\CmsBundle\Entity\Post;
use PhatKoala\CmsBundle\Entity\PostType;
use PhatKoala\CmsBundle\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/post/{type}/{id}/view", name="post_view", methods={"GET"})
 */
class ViewAction
{
    private Environment $twig;
    private PostRepository $repository;

    public function __construct(Environment $twig, PostRepository $repository)
    {
        $this->twig = $twig;
        $this->repository = $repository;
    }

    /**
     * @param PostType $type
     * @param Post $post
     * @return Response
     */
    public function __invoke(PostType $type, Post $post): Response
    {
        $parameters = [
            'type' => $type,
            'post' => $post,
        ];

        $templates = [
            sprintf('single-%s-%s', $type, $post->getSlug()),
            sprintf('single-%s', $type),
            'single'
        ];

        $loader = $this->twig->getLoader();
        foreach ($templates as $template) {
            if ($loader->exists($template)) {
                return new Response($this->twig->render($template, $parameters));
            }
        }

        return new Response($this->twig->render('@PhatKoalaCms/post/view/index.html.twig', $parameters));
    }
}
