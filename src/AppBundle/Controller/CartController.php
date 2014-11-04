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
    public function checkoutAction()
    {
        $cart = $this->get('cart');
    }

    /**
     * Add item to cart
     *
     * @Route("/add/{id}", name="cart_add", requirements={"id" = "\d+"})
     * @Template("AppBundle:Module:cart.html.twig")
     * @param int $id  Product id
     *
     */
    public function addAction($id)
    {
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
            $cart->add($product, 1);
        }

        return ['cart' => $cart];
    }
}