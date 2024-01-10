<?php

namespace App\Form\AddProductForm;

use App\Entity\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('artist', TextType::class)
            ->add('price', TextType::class)
            ->add('genre', TextType::class)
            ->add('cover', TextType::class)
            ->add('description', TextType::class)
            ->add('format', TextType::class)
            ->add('description', TextType::class)
            ->add('inventory', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }
}