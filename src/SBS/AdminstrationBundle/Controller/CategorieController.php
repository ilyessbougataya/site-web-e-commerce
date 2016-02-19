<?php

namespace SBS\AdminstrationBundle\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use SBS\AdminstrationBundle\Entity\Categorie;
use SBS\AdminstrationBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use SBS\AdminstrationBundle\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategorieController extends Controller
{
	// ajouter categorie
	public function addCategorieAction(Request $request){
	
	// On crée un objet Advert
    $catii = new Categorie();
   

 // J'ai raccourci cette partie, car c'est plus rapide à écrire !
    $form = $this->get('form.factory')->createBuilder('form', $catii)
      ->add('nom',     'text')
	  ->add('image',    new ImageType())
      ->add('Enregistrer',    'submit')
      ->getForm()
    ;
	
	// On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);
	if ($form->isValid()) {
	      // Ajoutez cette ligne :
      // c'est elle qui déplace l'image là où on veut les stocker
      $catii->getImage()->upload();
      $em = $this->getDoctrine()->getManager();
      $em->persist($catii);
      $em->flush();
	}
    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('SBSAdminstrationBundle:Categorie:addcategorie.html.twig', array(
      'form' => $form->createView(),
    ));
	}
	// ------------------- end Action - ajout
	
	
	
	
	
	public function testAction(Request $request){
		    // On crée un objet Advert
    $catii = new Categorie();

   

 // J'ai raccourci cette partie, car c'est plus rapide à écrire !
    $form = $this->get('form.factory')->createBuilder('form', $catii)
      ->add('nom',     'text')
	  ->add('image',    new ImageType())
      ->add('save',    'submit')
      ->getForm()
    ;
	
	   // On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);
	if ($form->isValid()) {
	      // Ajoutez cette ligne :
      // c'est elle qui déplace l'image là où on veut les stocker
      $catii->getImage()->upload();
      $em = $this->getDoctrine()->getManager();
      $em->persist($catii);
      $em->flush();
	}
    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('SBSAdminstrationBundle:Categorie:test.html.twig', array(
      'form' => $form->createView(),
    ));
	
	}
	// modifier categorie
	
	
	// supprimer categorie
	
    public function indexAction()
    {	
        return $this->render('SBSAdminstrationBundle:Categorie:index.html.twig');
    }
	
	public function listeCatAction(){
		
		$em = $this->getDoctrine()->getManager();
	
		$listecat = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->findAll()
		;
	
		return $this->render('SBSAdminstrationBundle:Categorie:listecat.html.twig', array( 'listecat' => $listecat ) );
	}
	
	public function editCategorieAction(Request $request,$idcat){
		 $catii = new Categorie();
	
		$em = $this->getDoctrine()->getManager();
	
		$catii = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->find($idcat)
		;
		
		$form = $this->get('form.factory')->createBuilder('form', $catii)
		->add('nom',     'text')
		->add('image',    new ImageType())
		->add('Enregistrer',    'submit')
		->getForm()
		;
		
		    $form->handleRequest($request);
			if ($form->isValid()) {
			// Ajoutez cette ligne :
			// c'est elle qui déplace l'image là où on veut les stocker
			$catii->getImage()->upload();
			$em = $this->getDoctrine()->getManager();
			$em->flush();
			}
		
		return $this->render('SBSAdminstrationBundle:Categorie:addcategorie.html.twig', array(
			'form' => $form->createView(),
		));
		
		
	}
	
	
	public function deleteCategorieAction($idcat){
		
		$catii = new Categorie();
	
		$em = $this->getDoctrine()->getManager();
	
		$catii = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->find($idcat)
		;
	
		
			$em = $this->getDoctrine()->getManager();
			$em->remove($catii);
			$em->flush();
			
		
		return $this->listeCatAction();
	}
	
}
