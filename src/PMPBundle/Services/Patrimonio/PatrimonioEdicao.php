<?php

namespace PMPBundle\Services\ContaPatrimonial;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Repository as PMPRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class PatrimonioEdicao
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

    public function salvar(PMPEntity\Patrimonio $patrimonio)
    {
        $this->em->persist($patrimonio);
        $this->em->flush();
    }


}