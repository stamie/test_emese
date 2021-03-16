<?php

namespace App\Controller;

use App\Entity\Modell;
use App\Entity\Furniture;
use App\Form\AddFurnitureType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Security\User as SecurityUser;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class FurnituresController extends AbstractController
{

    /**
     * @Route("/login", name="login")
     */
    public function index(): Response
    {
        $furnitures = $this->getDoctrine()->getRepository(Furniture::class)->findAll();
        return $this->render('furnitures/index.html.twig', [ 
          ]);
    }

    public function addfurniture(Request $request=null): Response
    {
        $furniture = new Furniture();

        $form = $this->createForm(AddFurnitureType::class, $furniture);

        $modells = $this->getDoctrine()
                ->getRepository(Modell::class)
                ->findAll();
        $arrayAttr = ["null" => "0"];
        foreach ($modells as $modell)
        {
            $arrayAttr[$modell->getType()] = $modell->getId();
        }
        $form
            ->add('modell_id', ChoiceType::class, [
                'choices' => $arrayAttr,
            ])
            ->add('submit', SubmitType::class);

        if ($request){
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getDoctrine()->getManager();
                $furniture = $form->getData();
                // tell Doctrine you want to (eventually) save the Furniture (no queries yet)
                $entityManager->persist($furniture);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
            

            }
        }
        

        return $this->render('furnitures/addfurniture.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}