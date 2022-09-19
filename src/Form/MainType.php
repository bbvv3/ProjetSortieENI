<?php

namespace App\Form;

use App\Entity\Campus;
use App\Models\RechercherSortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', EntityType::class, [
                'class'=>Campus::class,
                'label' => 'Campus',
                'choice_label'  => 'nom',
            ])
            ->add('search', SearchType::class, [
                'label' => 'Le nom de la sortie contient : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'search'
                ]
            ])
            ->add('dateDebut',DateType::class,[
                'label' => "Entre",
                'required' => false,
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c')
                ]
            ])
            ->add('dateFin',DateType::class,[
                'label' => "et",
                'required' => false,
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c')
                ]
            ])
            ->add('checkbox', ChoiceType::class, [
                'choices' =>
                    [
                    'Sorties dont je suis l\'organisateur/trice' => 'sortiesOrga',
                    'Sorties auxquelles je suis inscrit/e' => 'sortiesInscrit',
                    'Sorties auxquelles je ne suis pas inscrit/e' => 'sortiesNonInscrit',
                    'Sorties passées' => 'sortiesPassee'
                    ],
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercherSortie::class,
        ]);
    }
}
