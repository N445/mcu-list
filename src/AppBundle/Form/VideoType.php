<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('type', ChoiceType::class, [
                'label'   => 'Type du média',
                'choices' => [
                    'Film'  => 'Film',
                    'Série' => 'Série',
                ],
            ])
            ->add('resume', TextareaType::class, [
                'label'    => 'Résumé',
                'required' => false,
            ])
            ->add('duration', NumberType::class, [
                'label'    => 'Duré en minute',
                'required' => false,
            ])
            ->add('ordre', NumberType::class, [
                'label'    => 'Ordre',
                'required' => false,
            ])
            ->add('date', TextType::class, [
                'label'    => 'Date de sortie',
                'required' => false,
            ])
            ->add('downloaded', CheckboxType::class, [
                'label'    => 'Coché si télécharger',
                'required' => false,
            ])
            ->add('viewed', CheckboxType::class, [
                'label'    => 'Coché si vue',
                'required' => false,
            ])
            ->add('active', CheckboxType::class, [
                'label'    => 'Active',
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Video',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_video';
    }


}
