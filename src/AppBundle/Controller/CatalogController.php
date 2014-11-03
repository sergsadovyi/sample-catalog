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
     * Home page with category list and modules
     *
     * @Route("/", name="catalog_home")
     * @Template
     */
    public function homeAction()
    {
        return [];
    }

    public function categoryAction($id)
    {

    }

    public function productAction($id)
    {

    }
}