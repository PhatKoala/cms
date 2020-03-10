<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Controller\Taxonomy;

use PhatKoala\CmsBundle\Entity\Term;
use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Form\Taxonomy\CreateType;
use PhatKoala\CmsBundle\Repository\TermRepository;
use PhatKoala\CoreBundle\Annotation\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/{type}/create", name="taxonomy_create", methods={"GET", "POST"})
 * @Form(class=CreateType::class)
 */
class CreateAction extends AbstractController
{
    private TermRepository $repository;

    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Taxonomy $type
     * @param FormInterface<CreateType> $form
     * @return Response
     */
    public function __invoke(Taxonomy $type, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Term $taxonomy */
            $taxonomy = $form->getData();
            $taxonomy->setType($type);

            $this->repository->save($taxonomy);

            $this->addFlash('success', sprintf('%s successfully created.', $type->getName()));

            return $this->redirectToRoute('taxonomy_edit', ['id' => $taxonomy->getId(), 'type' => $type]);
        }

        return $this->render('@PhatKoalaCms/taxonomy/create/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
