<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $date = new DateTime("now");
        $immutable = DateTimeImmutable::createFromMutable( $date );
        
        $user = new User();
        $plainPassword = 'admin1234';
        $hashedPassword = $this->passwordHasher
            ->hashPassword($user, $plainPassword);
        $user->setEmail('admin@admin.com');
        $user->setPassword($hashedPassword);
        $user->setName('Admin');
        $user->setCreatedAt($immutable);
        $user->setUpdatedAt($immutable);
        $user->setRoles(['ROLE_ADMIN']);
            
        $manager->persist($user);

        $manager->flush();
    }
}
