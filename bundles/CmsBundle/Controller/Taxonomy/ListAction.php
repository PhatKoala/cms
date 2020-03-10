<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Taxonomy;

use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Form\Taxonomy\ListType;
use PhatKoala\CmsBundle\Query\TaxonomyQuery;
use PhatKoala\CmsBundle\Repository\TermRepository;
use PhatKoala\CoreBundle\Annotation\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/list", name="taxonomy_list", methods={"GET", "POST"})
 *
 * @Form(class=ListType::class)
 */
class ListAction extends AbstractController
{
    private TermRepository $repository;

    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Taxonomy $type
     * @param FormInterface<ListType> $form
     * @return Response
     */
    public function __invoke(Taxonomy $type, FormInterface $form): Response
    {
        $query = new TaxonomyQuery([
            'type' => $type,
        ]);

        $taxonomys = $this->repository->query($query);

        return $this->render('@PhatKoalaCms/taxonomy/list/index.html.twig', [
            'type' => $type,
            'taxonomys' => $taxonomys,
        ]);
    }
}
