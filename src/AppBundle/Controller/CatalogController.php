<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller for Catalog actions
 *
 * @Route("/catalog")
 */
class CatalogController extends Controller
{
    /**
     * Home page shows products from all categories
     *
     * @Route("/", name="catalog_home")
     */
    public function homeAction()
    {
        $response = $this->forward('AppBundle:Catalog:category', ['categoryAlias' => 'home']);

        return $response;
    }

    /**
     * Shows products in the selected category
     *
     * @Route("/{categoryAlias}", name="catalog_category", requirements={"categoryAlias" = "[a-z-]+"})
     * @Template
     *
     * @param string  $categoryAlias Category alias
     *
     * @return array  Product list
     */
    public function categoryAction($categoryAlias)
    {
        /**
         * @var \Doctrine\ORM\EntityManager          $em
         * @var \AppBundle\Entity\CategoryRepository $catRepo
         * @var \AppBundle\Entity\ProductRepository  $productRepo
         */
        $em          = $this->getDoctrine()->getManager();
        $catRepo     = $em->getRepository('AppBundle:Category');
        $productRepo = $em->getRepository('AppBundle:Product');

        // Get category info
        $category = $catRepo->getByAlias($categoryAlias);

        // Get category products
        $params = [];
        if (!is_null($category)) {
            $params['category'] = $category;
        }

        $products = $productRepo->getAll($params);

        return [
            'category' => $category,
            'products' => $products,
        ];
    }

    /**
     * Shows information about product
     *
     * @Route("/{categoryAlias}/{productAlias}", name="catalog_product", requirements={"categoryAlias" = "[a-z-]+", "productAlias" = "[a-z-]+"})
     * @Template
     *
     * @param string $productAlias  Product alias
     *
     * @return array  Product info
     */
    public function productAction($productAlias)
    {
        /**
         * @var \Doctrine\ORM\EntityManager          $em
         * @var \AppBundle\Entity\ProductRepository  $productRepo
         */
        $em          = $this->getDoctrine()->getManager();
        $productRepo = $em->getRepository('AppBundle:Product');

        $product = $productRepo->getByAlias($productAlias);

        return [
            'product' => $product,
        ];
    }
}