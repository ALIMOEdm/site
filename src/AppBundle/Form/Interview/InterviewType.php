<?php
namespace AppBundle\Form\Interview;

use AppBundle\Entity\Repository\Interview\SiteRepository;
use AppBundle\Entity\Repository\Interview\SiteVisitFrencityRepository;
use AppBundle\Entity\Repository\Interview\SiteVisitNumberRepository;
use AppBundle\Entity\Repository\Interview\WhatAboutNewsOtherCitiesRepository;
use AppBundle\Entity\Repository\Interview\WhatFunctionalRepository;
use AppBundle\Entity\Repository\Interview\WhatImportantRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterviewType extends AbstractType
{

    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('sites', EntityType::class, array(
                'label' => '',
                'class' => 'AppBundle:Interview\Site',
                'property' => 'title',
                'query_builder' => function(SiteRepository $er) {
                    $qb = $er->createQueryBuilder('e');
                    return $qb;
                },
                'attr' => array('class' => 'form-control', 'placeholder' => ''),
                'required' => true,
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '',
            ))
            ->add('frencity_site_visit', EntityType::class, array(
                'label' => '',
                'class' => 'AppBundle:Interview\SiteVisitFrencity',
                'property' => 'title',
                'query_builder' => function(SiteVisitFrencityRepository $er) {
                    $qb = $er->createQueryBuilder('e');
                    return $qb;
                },
                'attr' => array('class' => 'form-control', 'placeholder' => ''),
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'placeholder' => '',
            ))
            ->add('number_of_sites_u_see', EntityType::class, array(
                'label' => '',
                'class' => 'AppBundle:Interview\SiteVisitNumber',
                'property' => 'title',
                'query_builder' => function(SiteVisitNumberRepository $er) {
                    $qb = $er->createQueryBuilder('e');
                    return $qb;
                },
                'attr' => array('class' => 'form-control', 'placeholder' => ''),
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'placeholder' => '',
            ))
            ->add('what_important', EntityType::class, array(
                'label' => '',
                'class' => 'AppBundle:Interview\WhatImportant',
                'property' => 'title',
                'query_builder' => function(WhatImportantRepository $er) {
                    $qb = $er->createQueryBuilder('e');
                    return $qb;
                },
                'attr' => array('class' => 'form-control', 'placeholder' => ''),
                'required' => true,
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '',
            ))
            ->add('what_functional', EntityType::class, array(
                'label' => '',
                'class' => 'AppBundle:Interview\WhatFunctional',
                'property' => 'title',
                'query_builder' => function(WhatFunctionalRepository $er) {
                    $qb = $er->createQueryBuilder('e');
                    return $qb;
                },
                'attr' => array('class' => 'form-control', 'placeholder' => ''),
                'required' => true,
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '',
            ))
            ->add('news_other_cities', EntityType::class, array(
                'label' => '',
                'class' => 'AppBundle:Interview\WhatAboutNewsOtherCities',
                'property' => 'title',
                'query_builder' => function(WhatAboutNewsOtherCitiesRepository $er) {
                    $qb = $er->createQueryBuilder('e');
                    return $qb;
                },
                'attr' => array('class' => 'form-control', 'placeholder' => ''),
                'required' => true,
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    public function getName()
    {
        return 'interview_create';
    }

}