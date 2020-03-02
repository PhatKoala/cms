<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Taxonomy;

use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Entity\TaxonomyType;
use PhatKoala\CmsBundle\Repository\TaxonomyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/{id}/view", name="taxonomy_view", methods={"GET"})
 */
class ViewAction extends AbstractController
{
    private TaxonomyRepository $repository;

    public function __construct(TaxonomyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TaxonomyType $type
     * @param Taxonomy $taxonomy
     * @return Response
     */
    public function __invoke(TaxonomyType $type, Taxonomy $taxonomy): Response
    {
        return $this->render('taxonomy/view/index.html.twig', [
            'type' => $type,
            'taxonomy' => $taxonomy,
        ]);
    }
}
