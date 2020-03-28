<?php


namespace App\Form;


use App\Entity\Modelo;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModeloType extends AbstractType
{
    // como seran los campos de este formulario
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'marca',
                ChoiceType::class,
                [
                    'choices' => $options['marcas'],
                    'choice_label' => 'nombre',

                ]
            )
            ->add('nombre', TextType::class, ['label' => false])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Modelo::class,
                'marcas' => null
            ]
        );
    }

}