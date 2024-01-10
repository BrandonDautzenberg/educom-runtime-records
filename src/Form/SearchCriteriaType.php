<?php

namespace App\Form\SearchCriteriaType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchCriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search_criteria', TextType::class, ['required' => false, 'empty_data' => 'null'])
            ->add('save', SubmitType::class);
    }
}