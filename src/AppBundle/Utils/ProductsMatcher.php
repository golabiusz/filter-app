<?php

namespace AppBundle\Utils;

use AppBundle\Model\Product;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Products matcher by specific query.
 *
 * @author Dariusz Gołąbek <golabiusz@gmail.com>
 */
class ProductsMatcher
{
    /**
     * Filter query.
     * @var string 
     */
    private $query = '';

    /**
     * Translator service.
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * Constructor.
     * @param TranslatorInterface $translator translator service
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Filters products by query.
     * @param array $products products to filter
     * @param string $query filter query
     * @return array filtered products
     * @throws \InvalidArgumentException
     */
    public function getFilteredProducts(array $products, $query)
    {
        if (!$query || strlen($query) < 2) {
            throw new \InvalidArgumentException($this->translator->trans('filter.products.min_length'));
        }

        $this->query = $query;

        return array_values(array_filter($products, array($this, 'checkMatch')));
    }

    /**
     * Checks if product match to query.
     * @param Product $product product to check
     * @return boolean does product match to query
     */
    private function checkMatch(Product $product)
    {
        /**
         * @todo: configuration for checking if name, description or both match
         */
        return (stripos($product->getName(), $this->query) !== false ||
            stripos($product->getDescription(), $this->query) !== false);
    }
}
