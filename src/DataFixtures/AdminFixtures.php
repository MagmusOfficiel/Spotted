<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $encoder)
    {
    }

    public function load(ObjectManager $manager)
    {
        $user = new Utilisateur();
        $user->setUsername("eddy");
        $password = $this->encoder->hashPassword($user, 'ouinouin80');
        $user->setPassword($password);
        $user->setRoles("ROLE_ADMIN");
        $user->setUserPrenom("eddy");
        $user->setUserMail("eddyweber@sfr.fr"); 
        $date = new \DateTime();
        $user->setUserNaissance($date);
        $user->setUserSexe("Homme");
        $manager->persist($user);

        $manager->flush();
    }
}
