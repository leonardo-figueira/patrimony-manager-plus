<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="tbusuario")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nrusuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nousuario", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="nrcargo", type="integer")
     */
    private $cargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="nrcentro_custo", type="integer")
     */
    private $centroCusto;


    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $roles = array();

    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    public function __construct(){
        $this->salt = base_convert(sha1(uniqid(mt_rand(),true)),16,36);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = "ROLE_USER";

        return array_unique($roles);
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return int
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param int $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return int
     */
    public function getCentroCusto()
    {
        return $this->centroCusto;
    }

    /**
     * @param int $centroCusto
     */
    public function setCentroCusto($centroCusto)
    {
        $this->centroCusto = $centroCusto;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function equals(UserInterface $user){
        return $this->getId() == $user->getId();
    }

    public function eraseCredentials(){

    }

}

