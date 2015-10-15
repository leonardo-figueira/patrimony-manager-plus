<?php

namespace PMPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estabelecimento
 *
 * @ORM\Table(name="TBIMAGEM")
 * @ORM\Entity(repositoryClass="PMPBundle\Repository\ImagemRepository")
 */
class Imagem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updateAt;
    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }
    /**
     * @ORM\OneToMany(targetEntity="Patrimonio", mappedBy="imagem")
     */
    private $patrimonios = array();

    public function __construct()
    {
        $this->patrimonios = new ArrayCollection();
    }
    public $file;
    public function getUploadRootDir()
    {
        return __dir__.'/../../../web/imagens';
    }
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }
    /**
     * @ORM\Prepersist()
     * @ORM\Preupdate()
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt  = new \DateTime();
        if(null !== $this->file) $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
    }
    /**
     * @ORM\Postpersist()
     * @ORM\Postupdate()
     */
    public function upload()
    {
        if(null !==$this->file){
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);
            if($this->oldFile !==null) unlink($this->tempFile);
        }
    }
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if(file_exists($this->tempFile)) unlink($this->tempFile);
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
    public function getPath()
    {
        return $this->path;
    }
}

