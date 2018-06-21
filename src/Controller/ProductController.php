<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Entity\Product;

/**
 * @Route("/product", name="product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="product")
     */
    public function index(EntityManagerInterface $em)
    {
        $product = new Product();
        $categories = $em->getRepository(Category::class)
                        ->findAll();
//        $category->setName('Телевизоры');
//        $em->persist($category);
//        $em->flush();

//        $category = $em->getRepository(Category::class)->find(1);
//        $product = new Product();
//        $product->setTitle('Le Eco 2');
//        $product->setDescription('Описание телефона');
//        $product->setCategory($category);
//        // сообщает Doctrine, что вы (в итоге) хотите сохранить Product (пока запросов не будет)
//        $em->persist($product);
//
//        // теперь выполняются запросы (например, запрос INSERT)
//        $em->flush();
//        $repository = $em->getRepository('Category');

//        $category = $repository->find();

//
//        $product = new Product();
//        $product->setName('Keyboard');
//        $product->setPrice(19.99);
//        $product->setDescription('Ergonomic and stylish!');
//
//        // relates this product to the category
//        $product->setCategory($category);
//
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($category);
//        $entityManager->persist($product);
//        $entityManager->flush();
//
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'categories' => $categories,
            'product'  => $product,
        ]);
    }
//    public function index()
//    {
//        return $this->render('product/index.html.twig', [
//            'controller_name' => 'ProductController',
//        ]);
//    }
}
