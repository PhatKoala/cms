<?php

declare(strict_types=1);

namespace App\Controller\Demographic;

use App\Annotation\Form;
use App\Entity\Demographic;
use App\Entity\DemographicType;
use App\Form\Demographic\EditType;
use App\Repository\DemographicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/{id}/edit", name="demographic_edit", methods={"GET", "DEMOGRAPHIC"})
 *
 * @Form(class=EditType::class, data="demographic")
 */
class EditAction extends AbstractController
{
    private DemographicRepository $repository;

    public function __construct(DemographicRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param DemographicType $type
     * @param Demographic $demographic
     * @param FormInterface<EditType> $form
     * @return Response
     */
    public function __invoke(DemographicType $type, Demographic $demographic, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $demographic = $form->getData();
            $this->repository->save($demographic);

            $this->addFlash('success', sprintf('%s successfully updated.', $type->getName()));
        }

        return $this->render('demographic/edit/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
