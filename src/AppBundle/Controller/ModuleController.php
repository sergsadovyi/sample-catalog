<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller for Modules
 */
class ModuleController extends Controller
{
    /**
      * Returns list of categories
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
}