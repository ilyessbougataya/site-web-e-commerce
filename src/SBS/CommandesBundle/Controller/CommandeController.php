<?php

namespace SBS\CommandesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SBS\AdminstrationBundle\Entity\Categorie;
use SBS\AdminstrationBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommandeController extends Controller
{
    public function indexAction()
    {
        return $this->render('SBSCommandesBundle:Commande:index.html.twig');
    }
	
	
	public function viewCategorieAction(){
		
		$em = $this->getDoctrine()->getManager();
	
		$listecat = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->findAll()
		;
		
		return $this->render('SBSCommandesBundle:Commande:index2.html.twig', array( 'listecat' => $listecat ) );
			
	}
	
	public function viewProduitAction($idprd){
		
		$em = $this->getDoctrine()->getManager();
		$session = $this->getRequest()->getSession();
		 
		$prd = $em
		->getRepository('SBSAdminstrationBundle:Produit')
		->find($idprd)
		;
		
		if ($session->has('panier'))
        $panier = $session->get('panier');
        else
        $panier = false;
		
		return $this->render('SBSCommandesBundle:Commande:product.html.twig', array( 'produit' => $prd , 'panier' => $panier ) );
		
	}
	
	public function ViewCategoriesAction(){
		$em = $this->getDoctrine()->getManager();
	
		$listecat = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->findAll()
		;
	
		return $this->render('SBSCommandesBundle:Commande:categorie.html.twig', array( 'listecat' => $listecat ) );
	}
	
	public function ViewListeprdAction($id){
		
		$em = $this->getDoctrine()->getManager();
		
		$cat = $em
		->getRepository('SBSAdminstrationBundle:Categorie')
		->find($id)
		;
		
		$listeprd = $em
		->getRepository('SBSAdminstrationBundle:Produit')
		->findByCategorie($cat)
		;
		
		return $this->render('SBSCommandesBundle:Commande:listeproduit.html.twig', array( 'listeprd' => $listeprd  ) );
	}
	
	public function panAction($id, Request $request){
		
		$session = $this->getRequest()->getSession();
        
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
		
        if ( is_array($panier) && array_key_exists($id, $panier)) {
            if ($this->getRequest()->query->get('qte') != null) $panier[$id] = $this->getRequest()->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($this->getRequest()->query->get('qte') != null)
                $panier[$id] = $this->getRequest()->query->get('qte');
            else
                $panier[$id] = 1;
            
            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }
            
       die(print_r($session->get('panier')));
		
	}
	
	public function afficherAction(){
		$session = $this->getRequest()->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
        
		die(print_r($session->get('panier')));
        
	}
	
	public function ffff (){
	$qb = $this->getEntityManager()->createQueryBuilder();
    $qb->add('select', 'p.id, p.nom')
    ->add('from', 'SBSAdminstrationBundle:Produit p');
    $qb->add('where', $qb->expr()->in('p.id', $tags));
    $query = $qb->getQuery();
    $res = $query->getResult();
	
	}
	
	public function ajouterAction($id)
    {
        $session = $this->getRequest()->getSession();
        
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier)) {
            if ($this->getRequest()->query->get('qte') != null) $panier[$id] = $this->getRequest()->query->get('qte');
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($this->getRequest()->query->get('qte') != null)
                $panier[$id] = $this->getRequest()->query->get('qte');
            else
                $panier[$id] = 1;
            
            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }
            
        $session->set('panier',$panier);
        
        
        return $this->redirect($this->generateUrl('panier'));
    }
	
	public function panierAction()
    {
        $session = $this->getRequest()->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
       // $session->remove('panier');
       // $em = $this->getDoctrine()->getManager();
        //$produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));
			$qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder();
    $qb->add('select', 'p')
    ->add('from', 'SBSAdminstrationBundle:Produit p');
    $qb->add('where', $qb->expr()->in('p.id', array_keys($session->get('panier'))));
    $query = $qb->getQuery();
    $res = $query->getResult();
	
	
        //var_dump($session->get('panier'));
        //var_dump($session->get('panier'));
        return $this->render('SBSCommandesBundle:Commande:panier.html.twig', array('produits' => $res,
                                                                                             'panier' => $session->get('panier')));
    }
	
	public function supprimerAction($id)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }
        
        return $this->redirect($this->generateUrl('panier')); 
    }
}
