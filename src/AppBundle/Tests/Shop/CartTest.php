<?php
namespace AppBundle\Tests\Shop;

use AppBundle\Entity\Price;
use AppBundle\Entity\Product;
use AppBundle\Shop\Cart;

class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $session = $this->getMock('\\Symfony\\Component\\HttpFoundation\\Session\\Session');
        $cache   = $this->getMock('\\AppBundle\\Cache\\CacheInterface');
        $cache
            ->expects($this->exactly(1))
            ->method('get');

        $cart = new Cart($cache, $session);

        $this->assertCount(0, $cart->getItems());
        $this->assertEquals(0, $cart->getTotal());
    }

    /**
     * @dataProvider productProvider
     */
    public function testAdd($products)
    {
        $session = $this->getMock('\\Symfony\\Component\\HttpFoundation\\Session\\Session');
        $cache   = $this->getMock('\\AppBundle\\Cache\\CacheInterface');
        $cache
            ->expects($this->exactly(3))
            ->method('set');

        $cart = new Cart($cache, $session);

        $cart->add($products[0]);
        $cart->add($products[1]);
        $cart->add($products[2]);

        $this->assertCount(3, $cart->getItems());
        $this->assertEquals(60, $cart->getTotal());
    }

    /**
     * @dataProvider productProvider
     */
    public function testDel($products)
    {
        $session = $this->getMock('\\Symfony\\Component\\HttpFoundation\\Session\\Session');
        $cache   = $this->getMock('\\AppBundle\\Cache\\CacheInterface');
        $cache
            ->expects($this->exactly(2))
            ->method('set');

        $cart = new Cart($cache, $session);

        $cart->add($products[0]);
        $this->assertCount(1, $cart->getItems());

        $cart->del($products[0]);
        $this->assertCount(0, $cart->getItems());
    }

    public function productProvider()
    {
        $items = [];

        $price = new Price();
        $price->setValue(10);

        $item = new Product();
        $item->setId(1);
        $item->setPrice($price);
        $items[] = $item;

        $price = new Price();
        $price->setValue(20);

        $item = new Product();
        $item->setId(2);
        $item->setPrice($price);
        $items[] = $item;

        $price = new Price();
        $price->setValue(30);

        $item = new Product();
        $item->setId(3);
        $item->setPrice($price);
        $items[] = $item;

        return [[$items]];
    }
}
