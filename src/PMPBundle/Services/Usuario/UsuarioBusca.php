<?php

namespace PMPBundle\Services\Usuario;

use PMPBundle\Entity as PMPEntity;
use PMPBundle\Repository as PMPRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class UsuarioBusca
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
        $this->repository           = $this->em->getRepository('PMPBundle:Usuario');

    }

    public function buscarTodos(){
        return $this->repository->findAll();
    }

    public function buscarPorNome($login){
        return $this->repository->buscarPorNome($login);
    }

    public function salvar(PMPEntity\Usuario $usuario){
        $this->em->persist($usuario);
        $this->em->flush();
    }

    public function excluir(PMPEntity\Usuario $usuario){
        $this->em->remove($usuario);
        $this->em->flush();
    }

    public function alterar(PMPEntity\Usuario $usuario){
        $this->em->merge($usuario);
        $this->em->flush();
    }
}