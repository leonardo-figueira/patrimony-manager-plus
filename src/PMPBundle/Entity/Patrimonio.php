<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContaPatrimonial
 *
 * @ORM\Table(name="TB_PATRIMONIO")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\PatrimonioRepository")
 */
class Patrimonio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nrpatrimonio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nrplaqueta", type="string", length=100)
     */
    private $plaqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="nopatrimonio", type="string", length=255)
     */
    private $nopatrimonio;

    /**
     * @var date
     *
     * @ORM\Column(name="dtaquisicao", type="date")
     */
    private $dtaquisicao;


    /**
     * @var string
     *
     * @ORM\Column(name="nrnotafiscao", type="integer")
     */
    private $nrnotafiscal;

    /**
     * @var string
     *
     * @ORM\Column(name="situacao", type="integer", length=255)
     */
    private $situacao;

    /**
     * @var \PMPBundle\Entity\Patrimonio
     *
     * @ORM\ManyToOne(targetEntity="\PMPBundle\Entity\CentroCusto", cascade={"persist"})
     * @ORM\JoinColumn(name="nrcentro_custo", referencedColumnName="nrcentro_custo")
     */
    private $centroDeCusto;
    /**
     * @var \PMPBundle\Entity\Patrimonio
     *
     * @ORM\ManyToOne(targetEntity="\PMPBundle\Entity\ContaPatrimonial", cascade={"persist"})
     * @ORM\JoinColumn(name="nrconta_patrimonial", referencedColumnName="NRCONTA_PATRIMONIAL")
     */
    private $contaPatrimonial;

    /**
     * @ORM\ManyToOne(targetEntity="Imagem", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $imagem;


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
    public function getNopatrimonio()
    {
        return $this->nopatrimonio;
    }

    /**
     * @param string $nopatrimonio
     */
    public function setNopatrimonio($nopatrimonio)
    {
        $this->nopatrimonio = $nopatrimonio;
    }

    /**
     * @return date
     */
    public function getDtaquisicao()
    {
        return $this->dtaquisicao;
    }

    /**
     * @param date $dtaquisicao
     */
    public function setDtaquisicao($dtaquisicao)
    {
        $this->dtaquisicao = $dtaquisicao;
    }

    /**
     * @return string
     */
    public function getNrnotafiscal()
    {
        return $this->nrnotafiscal;
    }

    /**
     * @param string $nrnotafiscal
     */
    public function setNrnotafiscal($nrnotafiscal)
    {
        $this->nrnotafiscal = $nrnotafiscal;
    }

    /**
     * @return string
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * @param string $situacao
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    /**
     * @return ArrayCollection
     */
    public function getCentroDeCusto()
    {
        return $this->centroDeCusto;
    }

    /**
     * @param ArrayCollection $centroDeCusto
     */
    public function setCentroDeCusto($centroDeCusto)
    {
        $this->centroDeCusto = $centroDeCusto;
    }

    /**
     * @return ArrayCollection
     */
    public function getContaPatrimonial()
    {
        return $this->contaPatrimonial;
    }

    /**
     * @param ArrayCollection $contaPatrimonial
     */
    public function setContaPatrimonial($contaPatrimonial)
    {
        $this->contaPatrimonial = $contaPatrimonial;
    }

    /**
     * @return ArrayCollection
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param ArrayCollection $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    /**
     * @return string
     */
    public function getPlaqueta()
    {
        return $this->plaqueta;
    }

    /**
     * @param string $plaqueta
     */
    public function setPlaqueta($plaqueta)
    {
        $this->plaqueta = $plaqueta;
    }




}

