<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;

class RoomController extends AbstractController
{
    private $roomRepository;
    private $entityManager;

    public function __construct(RoomRepository $roomRepository, ManagerRegistry $doctrine)
    {
        $this->roomRepository = $roomRepository;
        $this->entityManager = $doctrine->getManager();
    }


    // show list rooms
    #[Route('/rooms', name: 'rooms')]
    public function showRooms(Request $request): Response
    {
        $rooms = $this->roomRepository->findAll();

        return $this->render('Pages/rooms.html.twig', [
           'rooms' => $rooms,
        ]);
    }
    

    // show list rooms
    #[Route('/room/{id}', name: 'room_details')]
    public function showRoomDetails(Request $request, $id): Response
    {
        $room = $this->roomRepository->find($id);

        return $this->render('Pages/room.html.twig', [
           'room' => $room,
        ]);
    }
    



}
