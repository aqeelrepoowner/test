<?php

namespace Acme\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\ProductBundle\Document\Product;
use Acme\ProductBundle\Form\Type\RegistrationType;

class DefaultController extends Controller
{	
	/**
     * @Route("/", name="product_lists")
     */
    public function indexAction()
    {

        return $this->render('AcmeProductBundle:Default:index.html.twig',array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..')));
    }

	public function createAction()
	{
		/*$product = new Product();
		$product->setName('A Foo Bar');
		$product->setPrice('19.99');

		$dm = $this->get('doctrine_mongodb')->getManager();
		$dm->persist($product);
		$dm->flush();

		return new Response('Created product id '.$product->getId());*/
	
		$form = $this->createForm(new RegistrationType(),new Product());
		
		return $this->render('AcmeProductBundle:Product:create_product.html.twig', array('form' => $form->createView()));


	}
}
