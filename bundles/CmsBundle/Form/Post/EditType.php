<?php

declare(strict_types=1);

namespace PhatKoala\CmsBundle\Form\Post;

use PhatKoala\CmsBundle\Entity\Post;
use PhatKoala\CmsBundle\Entity\Taxonomy;
use PhatKoala\CmsBundle\Repository\TaxonomyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'csrf_protection' => true,
            'allow_extra_fields' => true,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Post $post */
        $post = $options['data'];

        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => true,
            ])

            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'required' => false,
            ])

            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => true,
            ])

            ->add('excerpt', TextareaType::class, [
                'label' => 'Excerpt',
                'required' => false,
            ])

            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'required' => false,
                'placeholder' => ' - Please select - ',
                'choices' => [
                    'Draft' => 'draft',
                    'Pending' => 'pending',
                    'Publish' => 'publish',
                    'Trash' => 'trash',
                ]
            ])
        ;

        foreach ($post->getType()->getTaxonomies() as $taxonomy) {
            $builder
                ->add(sprintf('taxonomy_%s', $taxonomy->getType()), EntityType::class, [
                    'label' => $taxonomy->getName(),
                    'class' => Taxonomy::class,
                    'query_builder' => function (TaxonomyRepository $repository) use ($taxonomy) {
                        return $repository
                            ->createQueryBuilder('term')
                            ->andWhere('term.type = :type')
                            ->setParameter('type', $taxonomy);
                    },
                    'choice_label' => 'title',
                    'mapped' => false,
                ]);
        }
    }
}
