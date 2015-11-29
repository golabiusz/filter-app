<?php

namespace AppBundle\Controller;

use AppBundle\Model\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Filter controller.
 *
 * @author Dariusz Gołąbek <golabiusz@gmail.com>
 */
class FilterController extends BaseController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Filter:index.html.twig');
    }

    /**
     * @Route("/filter/{query}", name="filter")
     */
    public function filterAction($query)
    {
        try {
            $products = $this->getProducts();

            $filtered = $this->get('filter.utils.products_matcher')->getFilteredProducts($products, $query);

            return $this->createJsonResponse($this->createProductItems($filtered));
        } catch (\InvalidArgumentException $ex) {
            return $this->createClientError($ex->getMessage());
        } catch (\Exception $ex) {
            return $this->createServerError();
        }
    }

    /**
     * Convert products entites to array for response.
     * @param array $products products entities
     * @return array products data
     */
    private function createProductItems(array $products)
    {
        $items = [];

        for ($i = 0, $count = count($products); $i < $count; ++$i) {
            $items[] = $this->createProductItem($products[$i]);
        }

        return $items;
    }

    /**
     * Convert product entity to array.
     * @param Product $product product entity
     * @return array product data
     */
    private function createProductItem(Product $product)
    {
        return [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()
        ];
    }

    /**
     * Products list.
     * @return array Product entities
     */
    private function getProducts()
    {
        // products glossary
        $products = [
            [
                'name' => 'Black tea',
                'description' => 'Black tea is a type of tea that is more oxidized than oolong, green and white teas.'
            ],
            [
                'name' => 'Flowering tea',
                'description' => 'Flowering tea consist each of a bundle of dried tea leaves wrapped around one or more'
                    . ' dried flowers'
            ],
            [
                'name' => 'Green tea',
                'description' => 'Green tea is made from Camellia sinensis leaves that have undergone minimal oxidation'
                    . ' during processing'
            ],
            [
                'name' => 'White tea',
                'description' => 'White tea is made from Camellia sinensis.'
            ],
            [
                'name' => 'Yellow tea',
                'description' => 'Yellow tea is a rare and expensive variety of tea.'
            ]
        ];

        // simulate entities fetched from database
        $productsEntities = [];
        for ($i = 0, $count = count($products); $i < $count; ++$i) {
            $product = new Product();
            $product
                ->setName($products[$i]['name'])
                ->setDescription($products[$i]['description']);
            $productsEntities[] = $product;
        }

        return $productsEntities;
    }
}
