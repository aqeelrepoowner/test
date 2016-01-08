<?php

// src/Acme/ProductBundle/Form/Type/ProductType.php
namespace Acme\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'name');
        $builder->add('price','price' );
		$builder->add('description','description' );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\ProductBundle\Document\Product',
        ));
    }

    public function getName()
    {
        return 'Product';
    }
}	