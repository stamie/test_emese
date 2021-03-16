<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\LoginType as FormLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Security\User as SecurityUser;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(): Response
    {
        
        return $this->render('login/index.html.twig', [ 
          
        ]);
    }

    public function login(): Response
    {
        
        return $this->render('login/login.html.twig');
    
    }

    public function adduser()//: Response
    {
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $password = 'hahaha';
        $user = new User();
        $user->setEmail('estampel@gmail.com');
        
        $user->setRoles(['ROLE_ADMIN']);
        $user->setIsActive(true);

        // tell Doctrine you want to (eventually) save the User (no queries yet)
        
        $user->setPassword($password);
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return $this->redirectToRoute('login');
        
    }
}
