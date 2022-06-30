<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private $roomRepository;
    private $entityManager;
    private $passwordHasher;

    public function __construct(UserRepository $userRepository, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $doctrine->getManager();
        $this->passwordHasher = $passwordHasher;
    }


    #[Route('/register', name: 'app_register')]
    public function registerUser(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**  UploadedFile $brochureFile */
            $user = $form->getData();



            if ($request->files->get('user')['image']) {
                $image = $request->files->get('user')['image'];
                $image_name = time() . '_' . $image->getClientOriginalName();
                $image->move($this->getParameter('image_directory'), $image_name);
                $user->setImage($image_name);
            }

            //   password hashing
            $hashedPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->addFlash('success', 'Account created successfully! let\'s log in.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('Pages/register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
