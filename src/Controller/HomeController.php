<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // $user = $this->getUser();
        // $user = $userRepository->findOneBy('id');
        return $this->render('Pages/index.html.twig', [
            // 'user' => $user,
        ]);
    }
}
