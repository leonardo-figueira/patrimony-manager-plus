<?php

namespace PMPBundle\Services\ContaPatrimonial;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Repository as PMPRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class ContaPatrimonialBusca
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var TokenStorage
     */
    private $tokenStorage;
    /**
     * @var PMPRepository\ContaPatrimonialRepository
     */
    private $repository;

    public function __construct(EntityManager $entityManager, ContainerInterface $container)
    {
        $this->em                   = $entityManager;
        $this->container            = $container;
        $this->repository           = $this->em->getRepository('PMPBundle:ContaPatrimonial');

    }

    public function buscarPorId($id,$nome) {
        return $this->repository->buscarPorId($id,$nome);
    }

    public function buscarTodos() {
        return $this->repository->findAll();
    }

    public function findAll() {
        return $this->repository->findAll();
    }

}