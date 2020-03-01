<?php

declare(strict_types=1);

namespace App\Form\Taxonomy;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'allow_extra_fields' => true,
//            'factory' => fn(string $name, string $sku, int $quantity, float $price, Category $category) => new Product($name, $sku, $price, $category, $quantity),
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
//                'get_value' => fn(TaxonomyType $taxonomy) => $taxonomy->getTitle(),
//                'update_value' => fn(string $title, TaxonomyType $taxonomy) => $taxonomy->setName($title),
            ])
        ;
    }
}
