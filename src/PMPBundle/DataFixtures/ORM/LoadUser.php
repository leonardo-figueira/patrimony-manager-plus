<?php

namespace PMPBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PMPBundle\Entity\Usuario;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager){

        $user = new Usuario();
        $user->setNome("Leonardo Vicente Figueira");
        $user->setUserName("leonardo.figueira");
        $user->setPassword($this->encodePassword($user, "1frj7vr4"));
        $user->setCargo("1");
        $user->setCentroCusto("1");
        $manager->persist($user);

        $admin = new Usuario();
        $admin->setNome("Administrador");
        $admin->setUserName("admin");
        $admin->setPassword($this->encodePassword($admin, "admin"));
        $admin->setCargo("1");
        $admin->setCentroCusto("1");
        $admin->setRoles(array("ROLE_ADMIN"));
        $manager->persist($admin);

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;
    }

    private function  encodePassword($user,$plainPassword){
        $encoder = $this->container->get("security.encoder_factory")
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
}