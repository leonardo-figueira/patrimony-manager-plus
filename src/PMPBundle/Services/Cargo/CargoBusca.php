<?php

namespace PMPBundle\Services\Cargo;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Repository as PMPRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class CargoBusca
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
        $this->repository           = $this->em->getRepository('PMPBundle:Cargo');

    }

    public function buscarTodos(){
        return $this->repository->findAll();
    }

    public function buscarPorId($id){
        return $this->repository->buscarPorId($id);
    }


}