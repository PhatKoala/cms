<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Post;

use PhatKoala\CmsBundle\Entity\PostType;
use PhatKoala\CmsBundle\Form\Post\ListType;
use PhatKoala\CmsBundle\Query\PostQuery;
use PhatKoala\CmsBundle\Repository\PostRepository;
use PhatKoala\CoreBundle\Annotation\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post/{type}/list", name="post_list", methods={"GET", "POST"})
 *
 * @Form(class=ListType::class)
 */
class ListAction extends AbstractController
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PostType $type
     * @param FormInterface<ListType> $form
     * @return Response
     */
    public function __invoke(PostType $type, FormInterface $form): Response
    {
        $query = new PostQuery([
            'type' => $type,
        ]);
//        $query->type()->equal((string) $type);

        $posts = $this->repository->query($query);

        return $this->render('@PhatKoalaCms/post/list/index.html.twig', [
            'type' => $type,
            'posts' => $posts,
        ]);
    }
}
