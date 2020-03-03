<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\Demographic;

use PhatKoala\CoreBundle\Annotation\Form;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Entity\DemographicType;
use PhatKoala\UserBundle\Form\Demographic\CreateType;
use PhatKoala\UserBundle\Repository\DemographicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/create", name="demographic_create", methods={"GET", "POST"})
 * @Form(class=CreateType::class)
 */
class CreateAction extends AbstractController
{
    private DemographicRepository $repository;

    public function __construct(DemographicRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param DemographicType $type
     * @param FormInterface<CreateType> $form
     * @return Response
     */
    public function __invoke(DemographicType $type, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Demographic $demographic */
            $demographic = $form->getData();
            $demographic->setType($type);

            $this->repository->save($demographic);

            $this->addFlash('success', sprintf('%s successfully created.', $type->getName()));

            return $this->redirectToRoute('demographic_edit', ['id' => $demographic->getId(), 'type' => $type]);
        }

        return $this->render('@PhatKoalaUser/demographic/create/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
