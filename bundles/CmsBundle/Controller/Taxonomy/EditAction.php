<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Taxonomy;

use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Entity\TaxonomyType;
use PhatKoala\CmsBundle\Form\Taxonomy\EditType;
use PhatKoala\CmsBundle\Repository\TaxonomyRepository;
use PhatKoala\CoreBundle\Annotation\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/{id}/edit", name="taxonomy_edit", methods={"GET", "POST"})
 *
 * @Form(class=EditType::class, data="taxonomy")
 */
class EditAction extends AbstractController
{
    private TaxonomyRepository $repository;

    public function __construct(TaxonomyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TaxonomyType $type
     * @param Taxonomy $taxonomy
     * @param FormInterface<EditType> $form
     * @return Response
     */
    public function __invoke(TaxonomyType $type, Taxonomy $taxonomy, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $taxonomy = $form->getData();
            $this->repository->save($taxonomy);

            $this->addFlash('success', sprintf('%s successfully updated.', $type->getName()));
        }

        return $this->render('@PhatKoalaCms/taxonomy/edit/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
