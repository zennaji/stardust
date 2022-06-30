<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\User;
use App\Form\UserType;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class UserController extends AbstractController
{
    public function __construct(RoomRepository $roomRepository,  ManagerRegistry $doctrine, ReservationRepository $reservationRepository, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->roomRepository = $roomRepository;
        $this->reservationRepository = $reservationRepository;
        $this->entityManager = $doctrine->getManager();
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
      
    }
 
    #[Route('/user/reservations/', name: 'user_reservations')]
    public function index(): Response
    {
        $user  = $this->getUser();
        $reservations = $this->reservationRepository->findBy(['user' => $user]);
        return $this->render('user/reservation.html.twig', [
            'reservations' => $reservations,
            'user' => $user,
        ]);
    }


    // CREATE RESERVATION
    // #[Route('/user/reservation/create/{id}', name: 'reservation_create')]
    /**
     * @Route("/user/reservation/create/{id}", name="reservation_create")
     */
    public function createReservation(Request $request, $id, UserRepository $userRepository, Room $room, ReservationRepository $reservationRepository): Response
    {
  

        $roomName = $room->getTitle();
        // set current date in variable $date
        $date = new \DateTime();        

        

        $reservation = new Reservation();
        $reservation->setStatus('New');
        // $reservations = $reservationRepository->getUserReservation($user->getUserName());


        $form = $this->createForm(ReservationType::class, $reservation, [
            'current_locale' => 'en',
        ]);
        $checkin = $form->get('check_in')->getData();
        $checkout = $form->get('check_out')->getData();

        // calculation of days
        $date1_ts = strtotime($checkin);
        $date2_ts = strtotime($checkout);
        $diff = $date2_ts - $date1_ts;
        // $days = round($diff / 86400);
        $days = floor(abs($date2_ts - $date1_ts) / 86400);


        $form->handleRequest($request);
        $reservation->setRoom($room);
        $reservation->setName($userRepository->find($this->getUser())->getName());
        $reservation->setUser($this->getUser());

        
        
       
       $reservation->setDays($days);
    //    $reservation->setTotal($data["total"]);
    //    $reservation->setCreatedAt(new \DateTime()); // Get now datatime



        if ($form->isSubmitted() && $form->isValid()) {
            /**  UploadedFile $brochureFile */
            $reservation = $form->getData();
            // $reservation->setRoomId($id);
            //    $reservation->setUserid($user->getId());
            //    $reservation->setDays($days);

            $this->entityManager->persist($reservation);
            $this->entityManager->flush();
            $this->addFlash('success', 'Your reservation created successfully');

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('Pages/createReservation.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/user/profile/{id}', name: 'user_profile')]
    public function showProfile(User $user, Request $request, $id): Response
    {
        
        $user = $this->getUser();
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
            $this->addFlash('success', 'Account updated successfully');

            return $this->redirectToRoute('user_profile', ['id' => $user->getId()]);
        }




        return $this->render('user/profile.html.twig', [
            'form' => $form->createView(),
            'user' => $user,

        ]);
    }
}
