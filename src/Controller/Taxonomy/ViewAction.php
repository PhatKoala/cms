<?php

declare(strict_types=1);

namespace App\Controller\Taxonomy;

use App\Entity\Taxonomy;
use App\Entity\TaxonomyType;
use App\Repository\TaxonomyRepository;
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
