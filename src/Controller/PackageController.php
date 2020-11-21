<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends AbstractController
{
    /**
     * @Route("/package", name="package")
     */
    public function index(): Response
    {
        return $this->render('package/index.html.twig', [
            'controller_name' => 'PackageController',
        ]);
    }
}
