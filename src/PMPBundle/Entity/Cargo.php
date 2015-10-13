<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cargo
 *
 * @ORM\Table(name="TBCARGO")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\CargoRepository")
 */
class Cargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="NRCARGO", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOCARGO", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="cargo")
     */
    private $usuarios = array();

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Cargo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

}

