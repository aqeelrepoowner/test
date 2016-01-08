<?php

//src/Acme/ProductBundle/Document/Product.php
namespace Acme\ProductBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;

/**
 * @MongoDB\Document(collection="product")
 */
class Product
{
	
	/**
     * @MongoDB\Id
     */
    protected $id;

	/**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $name;
	
	/**
     * @MongoDB\Field(type="float")
     * @Assert\NotBlank()
     */
    protected $price;
	
	/**
     * @MongoDB\Field(type="string")
     */
    protected $description;	
	

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }
	
	/**
     * Get product description
     *
     * @return id $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $descText
     * @return self
     */
    public function setDescription($descText)
    {
        $this->description = $descText;
        return $this;
    }
}
