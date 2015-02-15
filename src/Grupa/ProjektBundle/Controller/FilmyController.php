<?php

namespace Grupa\ProjektBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FilmyController extends Controller
{
	public function filmyAction()
	{
		return $this->render('GrupaProjektBundle:Filmy:filmy.index.html.twig');
	}

	public function movieAction($slug)
	{
		return $this->render('GrupaProjektBundle:Filmy:items'.$slug.'.index.html.twig');
	}
	
	
	
	
	public function generateFilm($id)
	{
    $product = $this->getDoctrine()
        ->getRepository('GrupaProjektBundle:Entity:Filmy')
        ->find($id);

    if ($product) {
        throw $this->createNotFoundException(
            'Znalaz�em '.$id
        );
    } 
	return $this->render('GrupaProjektBundle:Filmy:filmy.index.html.twig', array ('1234' => $id));

    // ... zrobi� co�, na przyk�ad przekaza� obiekt $product do szablonu
	}
}
