<?php

namespace App\Controller;

use App\Entity\Care;
use App\Form\NewCareType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class CareController extends AbstractController
{
    /**
     * @Route("/care", name="care")
     */
    public function index()
    {
        return $this->render('care/index.html.twig', [
            'controller_name' => 'CareController',
        ]);
    }

    /**
     * @Route("/care/{id}", name="care_show", requirements={"id"="\d+"})
     */
    public function show(Care $care)
    {

        return $this->render('care/show.html.twig', [
            'care' => $care,
        ]);
    }

    /**
     * @Route("/care/new", name="new_care")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request)
    {
        $care = new Care();
        $form = $this->createForm(NewCareType::class, $care);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($care);
            $entityManager->flush();

            return $this->redirectToRoute("care_show", ['id'=>$care->getId()]);
        }

        return $this->render('care/new.html.twig', [
            'newCareForm' => $form->createView()
        ]);
    }
}
