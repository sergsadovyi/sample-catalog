<?php
namespace AppBundle\Shop;

use AppBundle\Cache\CacheInterface;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart
{
    /**
     * @var CacheInterface
     */
    protected $cache;
    /**
     * @var Session
     */
    protected $session;
    /**
     * @var array
     */
    protected $items;
    /**
     * @var string
     */
    protected $token;

    public function __construct(CacheInterface $cache, Session $session)
    {
        $this->cache   = $cache;
        $this->session = $session;

        $this->init();
    }

    /**
     * Retrives stored cart or creates a new one
     */
    protected function init()
    {
        // Identify cart token
        $cartToken = $this->session->get('cartToken');
        if (is_null($cartToken)) {
            $cartToken = 'cart_' . substr(md5(mt_rand(100,10000) . time()), 0, 7);

            $this->session->set('cartToken', $cartToken);
            $this->session->save();
        }

        $this->token = $cartToken;
        $this->getCached();
    }

    /**
     * Get cart items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Calculate total value of products in cart
     *
     * @return float
     */
    public function getTotal()
    {
        $total = 0;

        /**
         * @var CartItem $item
         */
        foreach ($this->items as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }

        return $total;
    }

    /**
     * Add product to cart
     *
     * @param Product $product
     * @param int     $quantity
     */
    public function add(Product $product, $quantity = 1)
    {
        /**
         * @var CartItem $item
         */
        if (isset($this->items[$product->getId()])) {
            $item = $this->items[$product->getId()];
        } else {
            $item = CartItem::createFromProduct($product);
        }
        $item->changeQuantity($quantity);

        // If quantity is 0, then delete from cart
        if ($item->getQuantity() == 0) {
            $this->del($product);
            return;
        }

        // Save data
        $this->items[$product->getId()] = $item;
        $this->store();
    }

    /**
     * Delete product from cart
     *
     * @param Product $product
     */
    public function del(Product $product)
    {
        unset($this->items[$product->getId()]);
        $this->store();
    }

    /**
     * Save cart data in cache
     */
    protected function store()
    {
        $items = serialize($this->items);
        $this->cache->set($this->token, $items);
    }

    /**
     * Get stored cart data from cache
     *
     * @return array of CartItems
     */
    protected function getCached()
    {
        $items = $this->cache->get($this->token);
        if (false === $items) {
            $items = [];
        } else {
            $items = @unserialize($items);
            if (false === $items) {
                $items = [];
            }
        }

        $this->items = $items;
    }
}