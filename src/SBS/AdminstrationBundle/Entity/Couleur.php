<?php

namespace SBS\AdminstrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Couleur
 *
 * @ORM\Table(name="couleur")
 * @ORM\Entity(repositoryClass="SBS\AdminstrationBundle\Repository\CouleurRepository")
 */
class Couleur
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
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="couleur")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
	private $produit;

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
     * Set produit
     *
     * @param \SBS\AdminstrationBundle\Entity\Produit $produit
     * @return Couleur
     */
    public function setProduit(\SBS\AdminstrationBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \SBS\AdminstrationBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
