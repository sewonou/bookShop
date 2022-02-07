<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {

        $roleUser = new Role();
        $roleUser->setTitle('ROLE_USER');
        $roleAdmin = new Role();
        $roleAdmin->setTitle('ROLE_ADMIN');

        $manager->persist($roleUser);
        $manager->persist($roleAdmin);



        $user = new User();
        $user->setLogin('root')
            ->setHash($this->encoder->encodePassword($user, 'password'))
            ->addRole($roleUser)
            ->addRole($roleAdmin);

        $manager->persist($user);

        $user = new User();
        $user->setLogin('sewonou')
            ->setHash($this->encoder->encodePassword($user, 'password'))
            ->addRole($roleUser);

        $manager->persist($user);

        $manager->flush();
    }
}
