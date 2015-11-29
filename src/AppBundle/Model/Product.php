<?php

namespace AppBundle\Model;

/**
 * Product model.
 *
 * @author Dariusz Gołąbek <golabiusz@gmail.com>
 */
class Product
{
    /**
     * Product name.
     * @var string
     */
    private $name;

    /**
     * Product description.
     * @var string
     */
    private $description;

    /**
     * Product price.
     * @var float
     */
    private $price;

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}
