<?php

namespace AppBundle\Tests\Utils;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * ProductsMatcher unit test.
 *
 * @author Dariusz Gołąbek <golabiusz@gmail.com>
 */
class ProductsMatcherTest extends KernelTestCase
{
    /**
     * Product matcher service.
     * @var ProductMatcher
     */
    private static $matcher;

    public static function setUpBeforeClass()
    {
        self::bootKernel();

        self::$matcher = static::$kernel->getContainer()->get('filter.utils.products_matcher');
    }

    public function testGetFilteredProductsByName()
    {
        $products = $this->getSampleProducts();
        $expected = [$products[1]];

        $this->assertEquals(
            self::$matcher->getFilteredProducts($products, 'another'),
            $expected
        );
    }

    public function testGetFilteredProductsByDescription()
    {
        $products = $this->getSampleProducts();
        $expected = [$products[0], $products[1]];

        $this->assertEquals(
            self::$matcher->getFilteredProducts($products, 'desc'),
            $expected
        );
    }

    private function getSampleProducts()
    {
        $someProduct = new \AppBundle\Model\Product();
        $someProduct->setName("Some product")->setDescription("Description of some product");
        $anotherProduct = new \AppBundle\Model\Product();
        $anotherProduct->setName("Another product")->setDescription("Description of another product");

        return [$someProduct, $anotherProduct];
    }
}
