<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\Demographic;

use PhatKoala\CoreBundle\Annotation\Form;
use PhatKoala\UserBundle\Entity\Group;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Form\Demographic\EditType;
use PhatKoala\UserBundle\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/{id}/edit", name="demographic_edit", methods={"GET", "POST"})
 *
 * @Form(class=EditType::class, data="demographic")
 */
class EditAction extends AbstractController
{
    private GroupRepository $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Demographic $type
     * @param Group $demographic
     * @param FormInterface<EditType> $form
     * @return Response
     */
    public function __invoke(Demographic $type, Group $demographic, FormInterface $form): Response
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $demographic = $form->getData();
            $this->repository->save($demographic);

            $this->addFlash('success', sprintf('%s successfully updated.', $type->getName()));
        }

        return $this->render('@PhatKoalaUser/demographic/edit/index.html.twig', [
            'type' => $type,
            'form' => $form->createView()
        ]);
    }
}
