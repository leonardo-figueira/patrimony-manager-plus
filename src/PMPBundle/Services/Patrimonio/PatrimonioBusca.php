<?php

namespace PMPBundle\Services\Patrimonio;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Repository as PMPRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class PatrimonioBusca
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
     * @var PMPRepository\PatrimonioRepository
     */
    private $repository;

    public function __construct(EntityManager $entityManager, ContainerInterface $container)
    {
        $this->em                   = $entityManager;
        $this->container            = $container;
        $this->repository           = $this->em->getRepository('PMPBundle:Patrimonio');

    }

    public function buscar($plaqueta,$descricao) {
        return $this->repository->buscar($plaqueta,$descricao);
    }

    public function findAll() {
        return $this->repository->findAll();
    }

    public function findById($id) {
        return $this->repository->findOneBy(array('id'=>$id));
    }
}