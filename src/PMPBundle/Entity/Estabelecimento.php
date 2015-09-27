<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estabelecimento
 *
 * @ORM\Table(name="TBESTABELECIMENTO")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\EstabelecimentoRepository")
 */
class Estabelecimento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="NRESTABELECIMENTO", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOESTABELECIMENTO", type="string", length=255)
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
     * @return Estabelecimento
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

