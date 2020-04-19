<?php

namespace App\Controller;

use App\Repository\CareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(CareRepository $careRepository)
    {
        $cares = $careRepository->findBy([]);
        return $this->render('main/index.html.twig', [
            'cares' => $cares,
        ]);
    }
}
