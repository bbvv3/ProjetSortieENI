<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom de la sortie',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],

            ])
            ->add('dateHeureDebut',DateType::class,[
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c'),
                    'label'=>'Date heure début'
                ]
            ])
            ->add('dateLimiteInscription',DateType::class,[
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c')
                ]
            ])
            ->add('duree',IntegerType::class,[
                'label'=>'Durée',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('nbInscriptionsMax',TextType::class,[
                'label'=>'Nombre de places',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('infosSortie',TextareaType::class,[
                'label'=>'Info sortie',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-5 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-7',
                ],
            ])
            ->add('siteOrganisateur',EntityType::class,[
                'label'=>'Site organisateur',
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
                ])
            ->add('lieuSortie',EntityType::class,[
                'label'=>'Lieu sortie',
                'class'=>Lieu::class,
                'choice_label'=>'nom'
            ])


            ->add('enregistrer', SubmitType::class, ['label' => 'Enregistrer'])
            ->add('publier', SubmitType::class, ['label' => 'Publier la sortie'])
            ->add('annuler', ResetType::class,['label'=>'Annuler'])
            ->add('delete', SubmitType::class,['label'=>'Supprimer la sortie'])
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
