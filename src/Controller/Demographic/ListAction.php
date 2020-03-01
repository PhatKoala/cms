<?php

declare(strict_types=1);

namespace App\Controller\Demographic;

use App\Annotation\Form;
use App\Entity\DemographicType;
use App\Form\Demographic\ListType;
use App\Query\DemographicQuery;
use App\Repository\DemographicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demographic/{type}/list", name="demographic_list", methods={"GET", "DEMOGRAPHIC"})
 *
 * @Form(class=ListType::class)
 */
class ListAction extends AbstractController
{
    private DemographicRepository $repository;

    public function __construct(DemographicRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param DemographicType $type
     * @param FormInterface<ListType> $form
     * @return Response
     */
    public function __invoke(DemographicType $type, FormInterface $form): Response
    {
        $query = new DemographicQuery([
            'type' => (string) $type,
        ]);
//        $query->type()->equal((string) $type);

        $demographics = $this->repository->query($query);

        return $this->render('demographic/list/index.html.twig', [
            'type' => $type,
            'demographics' => $demographics,
        ]);
    }
}
