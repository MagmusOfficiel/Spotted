<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{


    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
       
        $user = new Utilisateur();
        $user->setUsername("eddy");
        $password = $this->encoder->encodePassword($user, 'eddy80');
        $user->setPassword($password);
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setUserPrenom("eddy");
        $user->setUserMail("eddy@sfr.fr"); 
        $date = new \DateTime();
        $user->setUserNaissance($date);
        $user->setUserPays("France");
        $user->setUserSexe("Homme");
        $manager->persist($user);

        $manager->flush();
    }
}
