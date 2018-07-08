<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/8/2018
 * Time: 8:34 PM
 */

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class newCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('parent', EntityType::class, array(
                // looks for choices from this entity
                'class' => Category::class,
                'required' => false,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'mapped' => false
                )
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}