<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Shop\Cart;

/**
 * Controller for Modules
 */
class ModuleController extends Controller
{
    /**
      * Return list of categories
      *
      * @Template
      */
    public function categoriesAction($request)
    {
        /**
         * @var \Doctrine\ORM\EntityManager          $em
         * @var \AppBundle\Entity\CategoryRepository $catRepo
         */
        $em      = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('AppBundle:Category');

        $categories = $catRepo->getAll();

        $current = $request->get('categoryAlias', '');

        return [
            'categories' => $categories,
            'current'    => $current,
        ];

    }

    /**
      * Return breadcrumbs
      *
      * @Template
      */
    public function breadcrumbsAction($request)
    {
        /**
         * @var \Doctrine\ORM\EntityManager          $em
         * @var \AppBundle\Entity\CategoryRepository $catRepo
         * @var \AppBundle\Entity\ProductRepository  $productRepo
         */
        $em = $this->getDoctrine()->getManager();

        $links = [];

        // Home page
        $links[] = [
            'href'  => $this->generateUrl('catalog_home'),
            'title' => '⌂',
        ];

        // Category page
        $categoryAlias = $request->get('categoryAlias', '');
        if ($categoryAlias != '') {
            $catRepo  = $em->getRepository('AppBundle:Category');
            $category = $catRepo->getByAlias($categoryAlias);

            if (!is_null($category)) {
                $links[] = [
                    'href'  => $this->generateUrl('catalog_category', ['categoryAlias' => $categoryAlias]),
                    'title' => $category->getTitle(),
                ];
            }
        }

        // Product page
        $productAlias = $request->get('productAlias', '');
        if ($productAlias != '') {
            $productRepo = $em->getRepository('AppBundle:Product');
            $product     = $productRepo->getByAlias($productAlias);

            $links[] = [
                'href'  => $this->generateUrl('catalog_product', ['categoryAlias' => $categoryAlias, 'productAlias' => $productAlias]),
                'title' => $product->getTitle(),
            ];
        }

        return ['links' => $links];
    }

    /**
      * Return cart module html
      *
      * @Template
      */
    public function cartAction()
    {
        /**
         * @var Cart $cart
         */
        $cart = $this->get('cart');

        return ['cart' => $cart];
    }
}