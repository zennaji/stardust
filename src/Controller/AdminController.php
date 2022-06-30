<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\RoomRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->render('Admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    private $roomRepository;
    private $entityManager;

    public function __construct(RoomRepository $roomRepository, ManagerRegistry $doctrine, ReservationRepository $reservationRepository, UserRepository $userRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->userRepository = $userRepository;
        $this->roomRepository = $roomRepository;
        $this->entityManager = $doctrine->getManager();
    }

    // show list rooms
    #[Route('/admin/room', name: 'rooms_list')]
    public function hotel(Request $request): Response
    {
        $rooms = $this->roomRepository->findAll();

        return $this->render('Admin/room/room.html.twig', [
           'rooms' => $rooms,
        ]);
    }
    

    // CREATE ROOM
    #[Route('/admin/room/create', name: 'room_create')]
     public function createRoom(Request $request): Response
    {
        $room = new Room();    
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /**  UploadedFile $brochureFile */
               $room = $form->getData();
               
                if ($request->files->get('room')['image']) {
                    $image = $request->files->get('room')['image'];
                    $image_name = time() . '_' . $image->getClientOriginalName();
                    $image->move($this->getParameter('image_directory'), $image_name);
                    $room->setImage($image_name);
                }
    
                $this->entityManager->persist($room);
                $this->entityManager->flush();
                $this->addFlash('success', 'Room created successfully');
    
                return $this->redirectToRoute('rooms_list');
            }

        return $this->renderForm('Admin/room/createRoom.html.twig', [
            'form' => $form,
        ]);
    }


    // SHOW ROOM DETAILS
    #[Route('/admin/room/datails/{id}', name: 'room_show')]
     public function show(Room $room): Response
     {
        return $this->render('Admin/room/show.html.twig', [
           'room' => $room,
        ]);
     }

    #[Route('/admin/room/edit/{id}', name: 'room_edit')]
     public function editRoom(Room $room, Request $request): Response
     {
        
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /**  UploadedFile $brochureFile */
               $room = $form->getData();
    
                
                if ($request->files->get('room')['image']) {
                    $image = $request->files->get('room')['image'];
                    $image_name = time() . '_' . $image->getClientOriginalName();
                    $image->move($this->getParameter('image_directory'), $image_name);
                    $room->setImage($image_name);
                }
    
                $this->entityManager->persist($room);
                $this->entityManager->flush();
                $this->addFlash('success', 'Room updated successfully');
    
                return $this->redirectToRoute('rooms_list');
            }

        return $this->renderForm('Admin/room/edit.html.twig', [
            'form' => $form,
        ]);

     }

    //  DELETE
    #[Route('/admin/room/delete/{id}', name: 'room_delete')]
     public function delete(Room $room): Response
     {
        $filesystem = new Filesystem();
        $imagePath = './uploads/' . $room->getImage();
        if ($filesystem->exists($imagePath)) {
            $filesystem->remove($imagePath);
        }
        $this->entityManager->remove($room);
        $this->entityManager->flush();
        $this->addFlash('success', 'Room removed successfully');

        return $this->redirectToRoute('rooms_list');

     }


     // reservations part
     // show list reservations
    #[Route('/admin/reservation', name: 'reservation_list')]
    public function showReservation(Request $request): Response
    {
        $reservation = $this->reservationRepository->findAll();

        return $this->render('Admin/reservation/reservations.html.twig', [
           'reservations' => $reservation,
        ]);
    }

    // edit reservation
    #[Route('/admin/reservation/edit/{id}', name: 'reservation_edit')]
     public function editreservation(Reservation $reservation, Request $request): Response
     {
        
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /**  UploadedFile $brochureFile */
               $reservation = $form->getData();
    
            
    
                $this->entityManager->persist($reservation);
                $this->entityManager->flush();
                $this->addFlash('success', 'Room updated successfully');
    
                return $this->redirectToRoute('reservation_list');
            }

        return $this->renderForm('Admin/reservation/edit.html.twig', [
            'form' => $form,
        ]);

     }

     //  DELETE
    #[Route('/admin/reservation/delete/{id}', name: 'reservation_delete')]
    public function deleteReservation(Reservation $reservation): Response
    {
      
       $this->entityManager->remove($reservation);
       $this->entityManager->flush();
       $this->addFlash('success', 'reservation removed successfully');

       return $this->redirectToRoute('reservation_list');

    }
     // users part
     // show list of users
     #[Route('/admin/user', name: 'user_list')]
     public function showUsers(Request $request): Response
     {
         $user = $this->userRepository->findAll();
 
         return $this->render('Admin/user/users.html.twig', [
            'users' => $user,
         ]);
     }
    
     




}
