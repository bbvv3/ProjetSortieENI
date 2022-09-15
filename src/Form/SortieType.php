<?php

namespace App\Form;

use App\Entity\Sortie;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom de la sortie'
            ])
            ->add('dateHeureDebut',DateType::class,[
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c')
                ]
            ])
            ->add('dateLimiteInscription',DateType::class,[
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c')
                ]

            ])
            ->add('duree',IntegerType::class)
            ->add('nbInscriptionsMax',TextType::class,[
                'label'=>'Nombre de places'
            ])
            ->add('infosSortie')
            ->add('organisateur')
            ->add('siteOrganisateur')
            ->add('lieuSortie')
            ->add('enregistrer', SubmitType::class, ['label' => 'Enregistrer'])
            ->add('publier', SubmitType::class, ['label' => 'Publier la sortie'])


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
