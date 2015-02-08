<?php

namespace Uek\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jkanclerz\Component\Feed\Repository\FeedRepository;
use Uek\DemoBundle\Entity\Feed;
use Uek\DemoBundle\Form\FeedType;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends Controller

{
    public function indexAction()
    {
		$path = $this->get('kernel')->getRootDir();
		$path .= '/../var/feed.json';
		$feedRepo = new FeedRepository($path);
		
        return $this->render('UekDemoBundle:Feed:feeds.html.twig', 
			array(
				'name' => 'Pawel Futa',
				'feeds' => $feedRepo->findAll(),
				)
			);
    }
	public function createAction(Request $request)
	{
		$nameProvider = $this->get('pfuta_name_provider');
		$feed = new Feed();
		$form = $this->createForm(
			new FeedType(),
			$feed
		);
		
		if ($request->isMethod('POST') && $form->handleRequest($request)
		&& $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($feed);
			$em->flush();
			}
		
	
		
		return $this->render(
			'UekDemoBundle:Feed:create.html.twig',
				array(
					'name' => $nameProvider->getName(),
					'form' => $form->createView(),
				)
			);
	}
}
