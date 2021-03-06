<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class RoomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $constraints = array(
            new NotNull()
        );

        $builder
            ->add('name', TextType::class, array(
                    'label'         => 'Nom de la room',
                    'required'      => true,
                    'constraints'    => $constraints
                )
            )

            ->add('description', TextareaType::class, array(
                    'label'         => 'Description',
                    'required'      => false
                )
            )

            ->add('isActivated', ChoiceType::class, array(
                    'label'     => 'Activé',
                    'choices'   => array( true => 'Oui', false => 'Non'),
                    'expanded'  => true,
                    'multiple'  => false,
                    'required'  => false
                )
            )

            ->add('pictureName', FileType::class, array(
                    'label' => 'Image',
                    'required' => false
                )
            )

            ->add('users', EntityType::class, array(
                'label' => 'Invités de la room',
                'class' => 'UserBundle:User',
                'choice_label' => 'username',
                'multiple' => true
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Room'
        ));
    }
}
