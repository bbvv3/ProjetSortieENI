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

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom de la sortie :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                ],

            ])
            ->add('dateHeureDebut',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date et heure de la sortie :',
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                    'min'=>(new \DateTime())->format('c'),
                ],

            ])
            ->add('dateLimiteInscription',DateType::class,[
                'widget'=>'single_text',
                'label'=> 'Date limite d\'inscription :',
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                    'min'=>(new \DateTime())->format('c')
                ],

            ])
            ->add('duree',IntegerType::class,[
                'label'=> 'Durée :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                ],
            ])
            ->add('nbInscriptionsMax',TextType::class,[
                'label'=>'Nombre de places :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                ],
            ])
            ->add('infosSortie',TextareaType::class,[
                'label'=>'Description et infos :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                ],
            ])
            ->add('siteOrganisateur',EntityType::class,[
                'label'=>'Campus :',
                //ici on défini la taille du label
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                ],
                    'class'=>Campus::class,
                    'choice_label'=>'nom',
                ])
            ->add('lieuSortie',EntityType::class,[
                'label'=>'Lieu :',
                'class'=>Lieu::class,
                'choice_label'=>'nom',
                'label_attr'=>[
                    'class'=> 'col-6 py-2'
                ],
                // en dessou on definit la taille du champ
                'attr'=>[
                    'class'=>'col-5 offset-1',
                ]
            ])
            ->add('enregistrer', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr'=>[
                    'class'=>'btn btn-primary btn-lg'
                ]
            ])
            ->add('publier', SubmitType::class, [
                'label' => 'Publier la sortie',
                'attr'=>[
                    'class'=>'btn btn-primary btn-lg'
                ]
            ])
            ->add('delete', SubmitType::class,[
                'label'=>'Supprimer la sortie',
                'attr'=>[
                    'class'=>'btn btn-primary btn-lg'
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
