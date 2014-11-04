<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Shop\Cart;

/**
 * Controller for Cart actions
 *
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * Add item to cart
     *
     * @Route("/add/{id}", name="cart_add", requirements={"id" = "\d+"})
     * @Template("AppBundle:Module:cart.html.twig")
     *
     * @param int $id Product id
     *
     * @return array  Cart
     */
    public function addAction($id)
    {
        return $this->doCart($id, 'add');
    }

    /**
     * Del item from cart
     *
     * @Route("/del/{id}", name="cart_add", requirements={"id" = "\d+"})
     * @Template("AppBundle:Module:cart.html.twig")
     *
     * @param int $id Product id
     *
     * @return array  Cart
     */
    public function delAction($id)
    {
        return $this->doCart($id, 'del');
    }

    /**
     * Process actions on cart
     *
     * @param $id
     * @param $action
     *
     * @return array Cart
     */
    protected function doCart($id, $action) {
        /**
         * @var \Doctrine\ORM\EntityManager          $em
         * @var \AppBundle\Entity\Product            $product
         * @var \AppBundle\Entity\ProductRepository  $productRepo
         */
        $em          = $this->getDoctrine()->getManager();
        $productRepo = $em->getRepository('AppBundle:Product');

        /**
         * @var Cart $cart
         */
        $cart = $this->get('cart');

        $product = $productRepo->find($id);

        if (!is_null($product)) {
            switch ($action) {
                case 'add':
                    $cart->add($product, 1);
                    break;
                case 'del':
                    $cart->del($product);
                    break;
            }
        }

        return ['cart' => $cart];
    }
}