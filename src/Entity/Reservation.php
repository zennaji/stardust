<?php

namespace App\Entity;

use App\Entity\Room;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $phone;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $days;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $total;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updated_at;

   

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'date')]
    private $check_in;

    #[ORM\Column(type: 'date')]
    private $check_out;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $room;

   

    // public function __construct()
    // {
    //     $this->room = new ArrayCollection();
    //     // $this->room = new Room();

    // }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(int $days): self
    {
        $this->days = $days;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    // public function getRoom(): ?Collection
    // {
    //     return $this->room;
        
    // }
    // public function __toString()
    // {
    //     return $this->name;
    // }

    // public function setRoom(?Room $room): self
    // {
    //     $this->room = $room;

    //     return $this;
    // }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCheckIn(): ?\DateTimeInterface
    {
        return $this->check_in;
    }

    public function setCheckIn(\DateTimeInterface $check_in): self
    {
        $this->check_in = $check_in;

        return $this;
    }

    public function getCheckOut(): ?\DateTimeInterface
    {
        return $this->check_out;
    }

    public function setCheckOut(\DateTimeInterface $check_out): self
    {
        $this->check_out = $check_out;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }
    public function getRoomId(): ?Room
    {
        return $this->room->getId();
    }

    public function setRoomId(?Room $id): self
    {
        $this->roomid = $id;

        return $this;
    }
    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

   
}
