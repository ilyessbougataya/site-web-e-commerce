<?php

namespace SBS\AdminstrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="SBS\AdminstrationBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="produit")
	 * @ORM\JoinColumn( onDelete="CASCADE" )
     */
	private $categorie;
	
	/**
   * @ORM\ManyToOne(targetEntity="SBS\AdminstrationBundle\Entity\ImagePrd", cascade={"persist", "remove"})
   */
  private $imageprd;

	 
	/**
   * @ORM\OneToOne(targetEntity="SBS\AdminstrationBundle\Entity\ImageDescription", cascade={"persist", "remove"})
   */
  private $imagedes;
  
      /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;
	
	/**
     * @var string
     *
     * @ORM\Column(name="qnt", type="integer")
     */
	private $qnt;
	
	/**
     * @var string
     *
     * @ORM\Column(name="prix", type="float")
     */
	private $prix;
 

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
     * @return Produit
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
     * Set categorie
     *
     * @param \SBS\AdminstrationBundle\Entity\Categorie $categorie
     * @return Produit
     */
    public function setCategorie(\SBS\AdminstrationBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \SBS\AdminstrationBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set qnt
     *
     * @param integer $qnt
     * @return Produit
     */
    public function setQnt($qnt)
    {
        $this->qnt = $qnt;

        return $this;
    }

    /**
     * Get qnt
     *
     * @return integer 
     */
    public function getQnt()
    {
        return $this->qnt;
    }

    

    /**
     * Set imageprd
     *
     * @param \SBS\AdminstrationBundle\Entity\ImagePrd $imageprd
     * @return Produit
     */
    public function setImageprd(\SBS\AdminstrationBundle\Entity\ImagePrd $imageprd = null)
    {
        $this->imageprd = $imageprd;

        return $this;
    }

    /**
     * Get imageprd
     *
     * @return \SBS\AdminstrationBundle\Entity\ImagePrd 
     */
    public function getImageprd()
    {
        return $this->imageprd;
    }



    /**
     * Set prix
     *
     * @param float $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set imagedes
     *
     * @param \SBS\AdminstrationBundle\Entity\ImageDescription $imagedes
     * @return Produit
     */
    public function setImagedes(\SBS\AdminstrationBundle\Entity\ImageDescription $imagedes = null)
    {
        $this->imagedes = $imagedes;

        return $this;
    }

    /**
     * Get imagedes
     *
     * @return \SBS\AdminstrationBundle\Entity\ImageDescription 
     */
    public function getImagedes()
    {
        return $this->imagedes;
    }
}
