<?php

declare(strict_types=1);

namespace PhatKoala\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard", name="dashboard", methods={"GET"})
 */
class IndexAction extends AbstractController
{
    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return $this->render('@PhatKoalaDashboard/index/index.html.twig', [

        ]);
    }
}
