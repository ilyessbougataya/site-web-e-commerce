<?php

namespace SBS\AdminstrationBundle\Controller;

use SBS\AdminstrationBundle\Entity\Categorie;
use SBS\AdminstrationBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use SBS\AdminstrationBundle\Form\ImagePrdType;
use SBS\AdminstrationBundle\Form\ImageDescriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitController extends Controller
{
	// ajouter Produit
	public function addPrdAction($id,Request $request){
		
	// On crée un objet Advert
    $prd = new Produit();
	$c = new Categorie();
   


	// J'ai raccourci cette partie, car c'est plus rapide à écrire !
    $form = $this->get('form.factory')->createBuilder('form', $prd)
      ->add('nom',     'text')
      ->add('qnt',    'text')
	  ->add('prix',    'text')
	  ->add('imageprd',    new ImagePrdType())
	  ->add('imagedes',    new ImageDescriptionType())
	  ->add('Enregistrer',    'submit')
      ->getForm()
    ;
	
	// On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);
	if ($form->isValid()) {
		 $em = $this->getDoctrine()->getManager();
	 
		$c = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->find($id)
		;
	      // Ajoutez cette ligne :
      // c'est elle qui déplace l'image là où on veut les stocker
      $prd->getImageprd()->upload();
	  $prd->getImagedes()->upload();
	  $prd->setCategorie($c);
     
      $em->persist($prd);
      $em->flush();
	}
    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('SBSAdminstrationBundle:Produit:addprd.html.twig', array(
      'form' => $form->createView(),
    ));
		
		
	}
	// modifier Produit
	public function editPrdAction($id ,Request $request){
		
		$prd = new Produit();
	
		$em = $this->getDoctrine()->getManager();
	
		$prd = $em
		->getRepository('SBSAdminstrationBundle:Produit')
		->find($id)
		;
		
		$form = $this->get('form.factory')->createBuilder('form', $prd)
		->add('nom',     'text')
		->add('qnt',    'text')
		->add('prix',    'text')
		->add('imageprd',    new ImagePrdType())
		->add('imagedes',    new ImageDescriptionType())
		->add('Enregistrer',    'submit')
		->getForm()
		;
		
		    $form->handleRequest($request);
			if ($form->isValid()) {
			// Ajoutez cette ligne :
			// c'est elle qui déplace l'image là où on veut les stocker
			$prd->getImageprd()->upload();
			$prd->getImagedes()->upload();
			$em->flush();
			}
		
		return $this->render('SBSAdminstrationBundle:Produit:addprd.html.twig', array(
			'form' => $form->createView(),
		));
	}
	
	public function listeProduitAction($idcat){
		
		$em = $this->getDoctrine()->getManager();
		
		$cat = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->find($idcat)
		;
		
		$listeprd = $em
		->getRepository('SBSAdminstrationBundle:Produit')
		->findByCategorie($cat)
		;
		
		return $this->render('SBSAdminstrationBundle:Produit:listeproduit.html.twig', array( 'listeprd' => $listeprd  ) );
	}
	
	
	// supprimer Produit
	
	public function DeletePrdAction($id,$idcat) {
		
		$prd = new Produit();
	
		$em = $this->getDoctrine()->getManager();
	
		$prd = $em
		->getRepository('SBSAdminstrationBundle:Produit')
		->find($id)
		;
	
		
			$em = $this->getDoctrine()->getManager();
			$em->remove($prd);
			$em->flush();
			
		
		return $this->listeProduitAction($idcat);
		//$this->redirect('sbs_adminstration_listeproduit', array( 'idcat' => $idcat));
	}
	
	
	public function indexAction()
    {
		 return $this->render('SBSAdminstrationBundle:Produit:index.html.twig' );
	}
	
	
    public function ffAction()
    {
		
	/*
	$p = new Produit();
	$cat = new Categorie();
	
	$em = $this->getDoctrine()->getManager();
	
	$cati = $em
      ->getRepository('SBSAdminstrationBundle:Categorie')
      ->find(2)
    ;
	
	//$cat->setNom('styloyat');
	$p->setNom('stylo Bic');
	//$p->setCategorie($cat);
	$p->setCategorie($cati);
	
	
	
	

    //$em->persist($cat);	
	$em->persist($p);
	
	$em->flush();
	
	--------------------------------- */
	
	
	/*$repositorry = $this->getDoctrine()->getManager()->getRepository('SBSAdminstrationBundle:Produit');
	$repCat = $this->getDoctrine()->getManager()->getRepository('SBSAdminstrationBundle:Categorie');
	
	$pd = $repositorry->find(1); */

	$em = $this->getDoctrine()->getManager();
	
	$cati = $em
      ->getRepository('SBSAdminstrationBundle:Categorie')
      ->find(2)
    ;
	
	$listpd = $em
      ->getRepository('SBSAdminstrationBundle:Produit')
      ->findBy(array('categorie' => $cati)) 
    ;
	
	
        return $this->render('SBSAdminstrationBundle:Produit:index.html.twig' , array( 'liste' => $listpd ) );
        //return $this->render('SBSAdminstrationBundle:Produit:index.html.twig' , array( 'produit' => 'mouhcine' ) );
    }
}
