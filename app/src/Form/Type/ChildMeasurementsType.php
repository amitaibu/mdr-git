<?php


namespace App\Form\Type;


use App\Entity\ChildMeasurements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ChildMeasurementsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('height', NumberType::class, ['required' => true])
          ->add('weight', NumberType::class, ['required' => true])
          ->add('photo', FileType::class, [
            'label' => 'Photo',

              // unmapped means that this field is not associated to any entity property
            'mapped' => false,

              // make it optional so you don't have to re-upload the PDF file
              // everytime you edit the Product details
            'required' => false,

              // unmapped fields can't define their validation using annotations
              // in the associated entity, so you can use the PHP constraint classes
            'constraints' => [
              new File([
                'mimeTypes' => [
                  'image/jpeg',
                  'image/png',
                ],
                'mimeTypesMessage' => 'Please upload a valid image',
              ])
            ],
          ])
          ->add('save', SubmitType::class,
            [
              'attr' => ['class' => 'pure-button'],
            ]
          );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => ChildMeasurements::class,
        ]);
    }

}
