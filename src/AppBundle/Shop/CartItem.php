<?php
namespace AppBundle\Shop;

use AppBundle\Entity\Product;

class CartItem
{
    /**
     * @var int  Product id
     */
    protected $id;
    /**
     * @var string  Product title
     */
    protected $title;
    /**
     * @var string  Product alias
     */
    protected $alias;
    /**
     * @var float  Product price
     */
    protected $price;
    /**
     * @var int  Total products in cart
     */
    protected $quantity = 0;

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function changeQuantity($num) {
        $quantity = $this->quantity + (int)$num;
        if ($quantity < 0) {
            $quantity = 0;
        }

        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * New item factory
     *
     * @param Product $product
     *
     * @return CartItem
     */
    public static function createFromProduct(Product $product)
    {
        $item = new self();
        $item->setId($product->getId());
        $item->setAlias($product->getAlias());
        $item->setTitle($product->getTitle());
        $item->setPrice($product->getPrice()->getValue());

        return $item;
    }
}