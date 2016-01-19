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
    public function indexAction(Request $request)
    {		
		$productRepo = $this->get('doctrine_mongodb')
         ->getManager()
         ->createQueryBuilder('AcmeProductBundle:Product')
         ->limit(10)
         ->sort('price', 'ASC')
         ->getQuery()
		 ->execute();
			
		/*if($request->get('searchItem'))
		{
			$productRepo->field('name')->equals($request->get('searchItem'));
		}		*/
		//echo "<pre>";		
		
				/*$productLists = $productRepo->findAll();
				$products = $repository->findBy(
							array('name' => '')
							);
				*/
		
		if (!$productRepo) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}

        return $this->render('AcmeProductBundle:Product:index.html.twig',array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),'product_list'=>$productRepo));
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
