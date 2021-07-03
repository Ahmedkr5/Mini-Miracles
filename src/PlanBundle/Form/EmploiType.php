<?php

namespace PlanBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('seanceMatin',CheckboxType::class,['required'=> false])->add('seanceSoir',CheckboxType::class,['required'=> false])->add('idSalle',EntityType::class,
            array('class'=>'PlanBundle:Salles','choice_label'=>'nomSalle'))->add('idGroup',EntityType::class,
            array('class'=>'PlanBundle:Groupe','choice_label'=>'NomGroup'))->add('jour',EntityType::class,
            array('class'=>'PlanBundle:Jour','choice_label'=>'libelle'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PlanBundle\Entity\Emploi'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'planbundle_emploi';
    }


}
