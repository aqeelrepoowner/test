<?php

namespace Acme\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\AccountBundle\Form\Type\RegistrationType;
use Acme\AccountBundle\Form\Model\Registration;


class DefaultController extends Controller
{
    public function indexAction()
    {
		$mailer = $this->get('app.mailer');
		
        return $this->render('AccountBundle:Default:index.html.twig');
    }
	
	public function registerAction()
    {
        $form = $this->createForm(new RegistrationType(), new Registration());
		
        return $this->render('AccountBundle:Account:register.html.twig', array('form' => $form->createView()));
    }
	

	public function createAction()
	{
		
		$dm = $this->get('doctrine_mongodb')->getManager();
		
		$form = $this->createForm(new RegistrationType(), new Registration());
		
		$form->bind($this->getRequest());
	
		if ($form->isValid()) {
			
			$registration = $form->getData();

			$dm->persist($registration->getUser());
			$dm->flush();

			return $this->redirectToRoute('acme_account_create');
		}

		return $this->render('AccountBundle:Account:register.html.twig', array('form' => $form->createView()));
		
	}
}
