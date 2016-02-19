<?php

namespace SBS\AdminstrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="SBS\AdminstrationBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
   * @ORM\OneToOne(targetEntity="SBS\AdminstrationBundle\Entity\Image", cascade={"persist", "remove"})
   */
  private $image;

  
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;
   
	/**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=50 , nullable=true)
     */
	private $extension = null;
	
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
     * Set nom
     *
     * @param string $nom
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return Categorie
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set image
     *
     * @param \SBS\AdminstrationBundle\Entity\Image $image
     * @return Categorie
     */
    public function setImage(\SBS\AdminstrationBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \SBS\AdminstrationBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
