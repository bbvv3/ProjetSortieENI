<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom',TextType::class,[
                'label' => 'Nom de la sortie :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner un nom de la sortie!'
                    ]),
                    new Length([
                        'max' => 60,
                        'maxMessage' => 'Le nom de la sortie doit contenir {{ limit }} caractères maximum!',
                    ]),
                ],

            ])
            ->add('dateHeureDebut',DateTimeType::class,[
                'widget' => 'single_text',
                'label' => 'Date et heure de la sortie :',
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                    'min' =>  (new \DateTime())->format('c'),
                ],

            ])
            ->add('dateLimiteInscription',DateType::class,[
                'widget' => 'single_text',
                'label' => 'Date limite d\'inscription :',
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                    'min' => (new \DateTime())->format('c')
                ],

            ])
            ->add('duree',IntegerType::class,[
                'label'=> 'Durée :',
                //ici on défini la taille du label
                'label_attr' => [
                    'class'=> 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner la durée de la sortie!'
                    ]),
                ],
            ])
            ->add('nbInscriptionsMax',TextType::class,[
                'label' => 'Nombre de places :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner le nombre maximum d\'inscription disponible pour la sortie!'
                    ]),
                ],
            ])
            ->add('infosSortie',TextareaType::class,[
                'label' => 'Description et infos :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner la description de la sortie!'
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le nom de la sortie doit contenir {{ limit }} caractères maximum!',
                    ]),
                ],
            ])
            ->add('siteOrganisateur',EntityType::class,[
                'label' => 'Campus :',
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                ],
                    'class' => Campus::class,
                    'choice_label' => 'nom',
                ])
            ->add('lieuSortie',EntityType::class,[
                'label' => 'Lieu :',
                'class' => Lieu::class,
                'choice_label' => 'nom',
                'label_attr' => [
                    'class' => 'col-6'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-5 offset-1',
                ]
            ])
            ->add('enregistrer', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg'
                ]
            ])
            ->add('publier', SubmitType::class, [
                'label' => 'Publier la sortie',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg'
                ]
            ])
            ->add('delete', SubmitType::class,[
                'label' => 'Supprimer la sortie',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg'
                ]
            ])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
