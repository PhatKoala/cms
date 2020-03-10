<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Taxonomy;

use PhatKoala\CmsBundle\Entity\Term;
use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Form\Taxonomy\EditType;
use PhatKoala\CmsBundle\Repository\TermRepository;
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
    private TermRepository $repository;

    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Taxonomy $type
     * @param Term $taxonomy
     * @param FormInterface<EditType> $form
     * @return Response
     */
    public function __invoke(Taxonomy $type, Term $taxonomy, FormInterface $form): Response
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
