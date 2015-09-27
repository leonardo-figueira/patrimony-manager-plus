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
}

