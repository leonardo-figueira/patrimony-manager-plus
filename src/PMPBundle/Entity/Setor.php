<?php

namespace PMPBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Setor
 *
 * @ORM\Table(name="TBSETOR")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\SetorRepository")
 */
class Setor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="NRSETOR", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOSETOR", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="CentroCusto", mappedBy="setor")
     */
    private $centrosCustos = array();

    public function __construct()
    {
        $this->centrosCustos = new ArrayCollection();
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
     * @return Setor
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
    public function getCentrosCustos()
    {
        return $this->centrosCustos;
    }

}

