<?php

// src/Form/NoteType.php
namespace App\Form;

use App\Entity\Notes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$submitText = $options['submitText'];
        $builder
            ->add('title')
            ->add('img')
            ->add('date')
            ->add('text')
            ->add($submitText, SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Notes::class,
            'submitText' => 'save',
        ));
    }
}