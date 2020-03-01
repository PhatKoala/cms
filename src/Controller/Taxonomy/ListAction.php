<?php

declare(strict_types=1);

namespace App\Controller\Taxonomy;

use App\Annotation\Form;
use App\Entity\TaxonomyType;
use App\Form\Taxonomy\ListType;
use App\Query\TaxonomyQuery;
use App\Repository\TaxonomyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/list", name="taxonomy_list", methods={"GET", "TAXONOMY"})
 *
 * @Form(class=ListType::class)
 */
class ListAction extends AbstractController
{
    private TaxonomyRepository $repository;

    public function __construct(TaxonomyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TaxonomyType $type
     * @param FormInterface<ListType> $form
     * @return Response
     */
    public function __invoke(TaxonomyType $type, FormInterface $form): Response
    {
        $query = new TaxonomyQuery([
            'type' => $type,
        ]);

        $taxonomys = $this->repository->query($query);

        return $this->render('taxonomy/list/index.html.twig', [
            'type' => $type,
            'taxonomys' => $taxonomys,
        ]);
    }
}
