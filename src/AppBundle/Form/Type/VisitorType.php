<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\Model\VisitorModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class VisitorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'Prénom'))
            ->add('lastName', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'Nom'))
            ->add('birthday', BirthdayType::class, array('label' => 'Date de naissance', 'format' => 'dd-MMM-yyyy',
            'years' => range(1920,2017)))
            ->add('country', CountryType::class, array('label' => 'Pays', 'placeholder' => 'France', 'required' => false
                , 'empty_data' => 'France'))
            ->add('discount', CheckboxType::class, array('label' => 'Tarif réduit', 'required' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => VisitorModel::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_visitor';
    }


}
