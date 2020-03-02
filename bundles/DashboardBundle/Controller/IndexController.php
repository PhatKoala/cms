<?php

declare(strict_types=1);

namespace PhatKoala\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard", methods={"GET"})
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('@PhatKoalaDashboard/dashboard/index/index.html.twig', [

        ]);
    }
}
