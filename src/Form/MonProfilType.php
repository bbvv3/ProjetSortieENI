<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participant;
# use ContainerL9RxIeP\getCampusRepositoryService;
use Doctrine\ORM\EntityRepository;
use phpDocumentor\Reflection\PseudoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class MonProfilType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('pseudo',TextType::class,[
                'label' => 'Pseudo :',
                    // Ici on définit la taille du label
                    'label_attr' => [
                      'class' => 'col-5 py-2'
                    ],
                    // En dessous on définit la taille du champ
                    'attr' => [
                        'class' => 'col-7',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un pseudo!'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le pseudo doit contenir {{ limit }} caractères minimum!',
                        'max' => 50,
                        'maxMessage' => 'Le pseudo doit contenir {{ limit }} caractères maximum!',
                    ]),
                ],

            ])
            ->add('prenom',TextType::class,[
                'label' => 'Prénom :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5 py-2'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class'=>'col-7',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un prénom!'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le prénom doit contenir {{ limit }} caractères minimum!',
                        'max' => 80,
                        'maxMessage' => 'Le prénom doit contenir {{ limit }} caractères maximum!',
                    ]),
                ],
            ])
            ->add('nom',TextType::class,[
                'label'=>'Nom :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5 py-2'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class'=>'col-7',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un nom!'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom doit contenir {{ limit }} caractères minimum!',
                        'max' => 80,
                        'maxMessage' => 'Le nom doit contenir {{ limit }} caractères maximum!',
                    ]),
                ],
            ])
            ->add('telephone',TextType::class,[
                'label' => 'Téléphone :',
                'required' => false,
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5 py-2'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-7',
                ],
            ])
            ->add('mail',TextType::class,[
                'label' => 'Mail :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5 py-2'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-7',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un email!'
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'Le mail doit contenir {{ limit }} caractères maximum!',
                    ]),
                ],
            ])
            ->add('motPasse',RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options'  => ['label' => 'Mot de Passe :',
                    // Ici on définit la taille du label
                    'label_attr' => [
                        'class'=> 'col-5 py-2'
                    ],
                    // En dessous on définit la taille du champ
                    'attr' => [
                        'class'=>'col-7',
                        'pattern' => '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$',
                        'type' => 'password'
                    ]
                    ],
                'second_options' => ['label' => 'Confirmation :',
                    // Ici on définit la taille du label
                    'label_attr' => [
                        'class' => 'col-5 py-2'
                    ],
                    // En dessous on définit la taille du champ
                    'attr' => [
                        'class' => 'col-7',
                        'pattern' => '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$',
                        'type' => 'password'
                    ]
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ doit être rempli',
                    ])
                 ]
            ])
            ->add('campus',EntityType::class,[
                    'label' => 'Campus',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5 py-2'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-7',
                ],
                    'class' => Campus::class,
                    'choice_label' => 'nom',
                    'disabled' => true,

             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
