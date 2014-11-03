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
        return [];
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
        return [];
    }
}