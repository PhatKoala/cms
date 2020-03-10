<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Taxonomy;

use PhatKoala\CmsBundle\Entity\Term;
use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Repository\TermRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/{id}/view", name="taxonomy_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private TermRepository $repository;

    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Taxonomy $type
     * @param Term $taxonomy
     * @return Response
     */
    public function __invoke(Taxonomy $type, Term $taxonomy): Response
    {
        return $this->render('@PhatKoalaCms/taxonomy/view/index.html.twig', [
            'type' => $type,
            'taxonomy' => $taxonomy,
        ]);
    }
}
