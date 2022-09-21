<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participant;
# use ContainerL9RxIeP\getCampusRepositoryService;
use Doctrine\ORM\EntityRepository;
use phpDocumentor\Reflection\PseudoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Validator\Constraints\NotBlank;


class MonProfilType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('pseudo',TextType::class,[
                'label'=>'Pseudo :',
                    //ici on défini la taille du label
                    'label_attr'=>[
                      'class'=> 'col-5 py-2'
                    ],
                    // en dessou on definit la taille du champ
                    'attr'=>[
                        'class'=>'col-7',
                ],

            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('nom',TextType::class,[
                'label'=>'Nom :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('telephone',TextType::class,[
                'label'=>'Téléphone :',
                'required'=>false,
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('mail',TextType::class,[
                'label'=>'Mail :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('motPasse',RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped'=>false,
                'first_options'  => ['label' => 'Mot de Passe :',
                    //ici on défini la taille du label
                    'label_attr'=>[
                        'class'=> 'col-5 py-2'
                    ],
                    // en dessou on definit la taille du champ
                    'attr'=>[
                        'class'=>'col-7',
                        'pattern'=>'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$',
                        'type'=>'password'
                    ]
                    ],
                'second_options' => ['label' => 'Confirmation :',
                    //ici on défini la taille du label
                    'label_attr'=>[
                        'class'=> 'col-5 py-2'
                    ],
                    // en dessou on definit la taille du champ
                    'attr'=>[
                        'class'=>'col-7',
                        'pattern'=>'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$',
                        'type'=>'password'
                    ]
                ],
                'constraints'=>[
                    new NotBlank([
                        'message'=>'ce champ doit être remplit',
                    ])
                 ]
            ])
            ->add('campus',EntityType::class,[
                    'label'=>'Campus',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
                    'class'=>Campus::class,
                    'choice_label'=>'nom',
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
