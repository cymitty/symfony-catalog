<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
//use App\Entity\Product;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="categories")
     */
    public function index(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)
                        ->findAll();
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories'      => $categories,
        ]);
    }

    /**
     * @Route("/category/{name}", name="category")
     */
    public function category($name, EntityManagerInterface $em)
    {
        $category = $em->getRepository(Category::class)
                    ->findOneBy([
                        'name' => $name,
                    ]);
        if ( !$category ) {
            throw $this->createNotFoundException('Данная категория не существует, либо была перемещена');
        }

        $products = $category->getProducts();
        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
            'products'      => $products,
        ]);
    }
}
