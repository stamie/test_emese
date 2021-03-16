<?php

namespace App\Controller;

use App\Entity\Furniture;
use App\Entity\Modell;
use App\Form\FurnitureType;
use App\Repository\FurnitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @Route("/furniture")
 */
class FurnitureController extends AbstractController
{
    /**
     * @Route("/", name="furniture_index", methods={"GET"})
     */
    public function index(FurnitureRepository $furnitureRepository): Response
    {
        $limit = 10;
        $page = 0;
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }

        $pages = intdiv(count($furnitureRepository->findAll()),  $limit);

        return $this->render('furniture/index.html.twig', [
            'pages' => $pages,
            'furniture' => $furnitureRepository->createQueryBuilder('p')
                                               ->setMaxResults( $limit )
                                               ->setFirstResult( $limit*$page )
                                               ->getQuery()
                                               ->getResult(),
        ]);
    }

    private function returnAllModells()//: array
    {
        $modells = $this->getDoctrine()
                ->getRepository(Modell::class)
                ->findAll();
        $arrayAttr = ["null" => "0"];
        foreach ($modells as $modell)
        {
            $arrayAttr[$modell->getType()] = $modell->getId();
        }
        return $arrayAttr;
    }

    /**
     * @Route("/new", name="furniture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $furniture = new Furniture();
        $form = $this->createForm(FurnitureType::class, $furniture);
        $form->add('modell_id', ChoiceType::class, [
                'choices' => $this->returnAllModells(),
            ])
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($furniture);
            $entityManager->flush();

            return $this->redirectToRoute('furniture_index');
        }

        return $this->render('furniture/new.html.twig', [
            'furniture' => $furniture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="furniture_show", methods={"GET"})
     */
    public function show(Furniture $furniture): Response
    {
        return $this->render('furniture/show.html.twig', [
            'furniture' => $furniture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="furniture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Furniture $furniture): Response
    {
        $form = $this->createForm(FurnitureType::class, $furniture);
        $form->add('modell_id', ChoiceType::class, [
            'choices' => $this->returnAllModells(),
        ])
        ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('furniture_index');
        }

        return $this->render('furniture/edit.html.twig', [
            'furniture' => $furniture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="furniture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Furniture $furniture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$furniture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($furniture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('furniture_index');
    }
}
