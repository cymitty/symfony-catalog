<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Entity\Product;

/**
 * @Route("/s", name="shop")
 */
class ShopController extends Controller
{
    /**
     * $products - Лучшие предложения ( выставляются вадминке ) как на dns-shop.ru
     * @Route("/", name="categories")
     */
    public function index(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)
                        ->findAll();
        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
            'categories'      => $categories,
        ]);
    }

    /**
     * @Route("/category/{slug}", name="_categoryByName")
     */
    public function category($slug, EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)
            ->findAll();

        $category = $em->getRepository(Category::class)
            ->findOneBy([
                'slug' => $slug,
                ]);

        if ( !$category ) {
            throw $this->createNotFoundException('Данная категория не существует, либо была перемещена');
        }

        $products = $category->getProducts();
        return $this->render('shop/category.html.twig', [
            'controller_name' => 'ShopController',
            'categories'      => $categories,
            'products'      => $products,
        ]);
    }

    /**
     * @Route("/product/{slug}", name="_product")
     */
    public function product($slug, EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)
            ->findAll();

        $product = $em->getRepository(Product::class)
            ->findOneBy([
                'slug' => $slug
            ]);
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
        return $this->render('shop/product.html.twig', [
            'controller_name' => 'ShopController',
            'categories' => $categories,
            'product'  => $product,
        ]);
    }
    /**
     * @Route("/test", name="_test")
     */
    public function test(EntityManagerInterface $em)
    {
//        $cars = new Category();
//        $cars->setSlug('mashiny');
//
//        $lada = new Category();
//        $lada->setSlug('lada');
//
//        $mazda = new Category();
//        $mazda->setSlug('mazda');
//
//        $cars->setChildrens($lada);
//        $cars->setChildrens($mazda);
//
//        $em->persist($cars);
//        $em->persist($lada);
//        $em->persist($mazda);
//
//        $telefony = $em->getRepository(Category::class)
//            ->findOneBy([
//                'id' => 23,
//            ]);
//
//        $LeEco = new Category();
//        $LeEco->setSlug('Le-Eco');
//
//        $telefony->setChildrens($LeEco);
//
//        $em->persist($LeEco);
//        $em->persist($telefony);
//
//        $em->flush();
//
//        $category = $em->getRepository(Category::class)->findAll();
//
//        var_dump($category);
//        return $this->render('shop/test.html.twig');



//        $category = new Category();
//        $category->setSlug('telefony');
//
//        $iphone = new Category();
//        $iphone->setSlug('iphone');
//
//        $category->setChildrens($iphone);
//
//        $em->persist($category);
//        $em->persist($iphone);
//        $em->flush();
//        var_dump($category);
//        return $this->render('shop/test.html.twig');


//
//        $category = $em->getRepository(Category::class)
//            ->findOneBy([
//                'id' => 23,
//            ]);
//
//        $samsung = new Category();
//        $samsung->setSlug('samsung');
//        $category->setChildrens($samsung);
//        $em->persist($samsung);
//        $em->persist($category);
//        $em->flush();
//        var_dump($category);
//        return $this->render('shop/test.html.twig');



        $categories = $em->getRepository(Category::class)->findAll();

        // Вынести создание дерева в отдельный класс или функцию

//        $tree = '';
//        foreach ($category as $item) {
//            if ( ( $subCats = $item->getChildrens() ) != null) {
//                $tree .= '<li>' . $item->getSlug() . '</li>';
//                $tree .= '<ul>';
//                foreach ($subCats as $item) {
//                    $tree .= '<li>'. $item->getSlug() . '</li>';
//                }
//                $tree .= '</ul>';
//            }
//        }

            $categoriesTree = [];
            foreach ($categories as $category) {
                $subCats = $category->getChildrens();  // objects Category
                if ( isset($subCats) ) {
                    $subCatsList= [];
                    foreach ($subCats as $subCat) {
                        $subCatsList[] = $subCat->getSlug();
                    }
                    $categoriesTree[] = array(
                        'slug' => $category->getSlug(),
                        'subCats' => $subCatsList
                    );
                }
        }


        var_dump($categories);
        var_dump($categoriesTree);
//        var_dump($telefoneSubCats);
        return $this->render('shop/test.html.twig');
    }
}
