<?php

declare(strict_types=1);

namespace App\Controller\Taxonomy;

use App\Annotation\Form;
use App\Entity\Taxonomy;
use App\Entity\TaxonomyType;
use App\Form\Taxonomy\CreateType;
use App\Repository\TaxonomyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/create", name="taxonomy_create", methods={"GET", "TAXONOMY"})
 * @Form(class=CreateType::class)
 */
class CreateAction extends AbstractController
{
    private TaxonomyRepository $repository;

    public function __construct(TaxonomyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TaxonomyType $type
     * @param FormInterface<CreateType> $form
     * @return Response
     */
    public function __invoke(TaxonomyType $type, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Taxonomy $taxonomy */
            $taxonomy = $form->getData();
            $taxonomy->setType($type);

            $this->repository->save($taxonomy);

            $this->addFlash('success', sprintf('%s successfully created.', $type->getName()));

            return $this->redirectToRoute('taxonomy_edit', ['id' => $taxonomy->getId(), 'type' => $type]);
        }

        return $this->render('taxonomy/create/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
