<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BalieController extends AbstractController
{
    public function __construct(ReservationRepository $reservationRepository, ManagerRegistry $doctrine, RoomRepository $roomRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->entityManager = $doctrine->getManager();
        $this->roomRepository = $roomRepository;
    }
   
    #[Route('/balie', name: 'balie_dashboard')]
    public function index(): Response
    {
        return $this->render('balie/index.html.twig', [
             
        ]);
    }

    #[Route('/balie/reservations', name: 'balie_reservation')]
    public function showReservations(): Response
    {
        $reservations = $this->reservationRepository->findAll();
        return $this->render('balie/reservations.html.twig', [
             'reservations' => $reservations,
        ]);
    }
    #[Route('/balie/rooms', name: 'balie_rooms')]
    public function showRooms(): Response
    {
        $rooms = $this->roomRepository->findAll();
        return $this->render('balie/rooms.html.twig', [
            'rooms' => $rooms,
        ]);
    }
    
}
