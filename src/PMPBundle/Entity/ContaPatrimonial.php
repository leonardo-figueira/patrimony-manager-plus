<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContaPatrimonial
 *
 * @ORM\Table(name="TBCONTA_PATRIMONIAL")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\ContaPatrimonialRepository")
 */
class ContaPatrimonial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="NRCONTA_PATRIMONIAL", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOCONTA_PATRIMONIAL", type="string", length=255)
     */
    private $nome;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Patrimonio", mappedBy="contaPatrimonial", cascade={"all"}, orphanRemoval=true)
     **/
    private $patrimonios;


    /**
     * @var string
     *
     * @ORM\Column(name="STATUS", type="integer")
     */
    private $status;

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
     * @return ContaPatrimonial
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'contapatrimonial' => $this->nome,
        );
    }

}

