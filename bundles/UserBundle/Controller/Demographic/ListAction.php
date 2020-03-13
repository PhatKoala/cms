<?php

declare(strict_types=1);

namespace PhatKoala\UserBundle\Controller\Demographic;

use PhatKoala\CoreBundle\Annotation\Form;
use PhatKoala\UserBundle\Entity\Demographic;
use PhatKoala\UserBundle\Form\Demographic\ListType;
use PhatKoala\UserBundle\Query\DemographicQuery;
use PhatKoala\UserBundle\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/list", name="demographic_list", methods={"GET", "POST"})
 *
 * @Form(class=ListType::class)
 */
class ListAction extends AbstractController
{
    private GroupRepository $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Demographic $type
     * @param FormInterface<ListType> $form
     * @return Response
     */
    public function __invoke(Demographic $type, FormInterface $form): Response
    {
        $query = new DemographicQuery([
            'type' => (string) $type,
        ]);
//        $query->type()->equal((string) $type);

        $demographics = $this->repository->query($query);

        return $this->render('@PhatKoalaUser/demographic/list/index.html.twig', [
            'type' => $type,
            'demographics' => $demographics,
        ]);
    }
}
