<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('news_text')
            ->add('news_text_origin')
            ->add('news_text_parsed')
            ->add('news_title')
            ->add('news_description')
            ->add('news_id')
            ->add('news_site_link')
            ->add('news_vk_link')
            ->add('news_date')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
            ->add('news_date_time', 'datetime')
            ->add('slug')
            ->add('deleted')
            ->add('category')
            ->add('vk_group')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\News'
        ));
    }
}
