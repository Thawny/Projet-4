<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\Model\CommandModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;


class CommandType extends AbstractType
{
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($this->router->generate('submit_command_form'))
            ->add('dateVisit', DateType::class, array('label' => 'Date de visite', 'required' => true, 'format' => 'dd-MMM-yyyy'))
            ->add('email', EmailType::class, array('required' => false))
            ->add('fullDayTickets', CheckboxType::class, array('label' => 'Journée complète', 'required' => false))
            ->add('visitors', CollectionType::class, array('entry_type' => VisitorType::class, 'allow_add' => true, 'allow_delete' => true, 'required' => true,
                    'label' => false))
            ->add('continuer', SubmitType::class)
            ;

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CommandModel::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_command';
    }

    /**
     * @param RouterInterface $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }



}
