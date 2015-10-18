<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargo
 *
 * @ORM\Table(name="tbcentro_custo")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\CentroCustoRepository")
 */
class CentroCusto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcentro_custo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nrcentro_custo", type="float")
     */
    private $nrcentroCusto;


    /**
     * @var string
     *
     * @ORM\Column(name="nocentro_custo", type="string", length=255)
     */
    private $nocentroCusto;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Patrimonio", mappedBy="centroDeCusto", cascade={"all"}, orphanRemoval=true)
     **/
    private $patrimonios;


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
     * @return string
     */
    public function getNocentroCusto()
    {
        return $this->nocentroCusto;
    }

    /**
     * @param string $nocentroCusto
     */
    public function setNocentroCusto($nocentroCusto)
    {
        $this->nocentroCusto = $nocentroCusto;
    }

    /**
     * @return Patrimonio
     */
    public function getPatrimonios()
    {
        return $this->patrimonios;
    }

    /**
     * @param Patrimonio $patrimonios
     */
    public function setPatrimonios($patrimonios)
    {
        $this->patrimonios = $patrimonios;
    }

    /**
     * @return string
     */
    public function getNrcentroCusto()
    {
        return $this->nrcentroCusto;
    }

    /**
     * @param string $nrcentroCusto
     */
    public function setNrcentroCusto($nrcentroCusto)
    {
        $this->nrcentroCusto = $nrcentroCusto;
    }


}

