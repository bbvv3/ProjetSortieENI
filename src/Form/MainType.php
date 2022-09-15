<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Sortie;
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
                'attr' => [
                    'placeholder' => 'search'
                ]
            ])
            //->add('datesSortie', DateType::class, [
            //    'label' => 'Entre ',
            //    'date' => date(Y-m-d),
            //])
            ->add('sortiesOrga', CheckboxType::class, [
                'label'    => 'Sorties dont je suis l\'organisateur/trice',
                'required' => false,
            ])
            ->add('sortiesInscrit', CheckboxType::class, [
                'label'    => 'Sorties auxquelles je suis inscrit/e',
                'required' => false,
            ])
            ->add('sortiesNonInscrit', CheckboxType::class, [
                'label'    => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false,
            ])
            ->add('sortiesPassee', CheckboxType::class, [
                'label'    => 'Sorties passées',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class, //todo creer une nouvelle classe pour gerer les filtres
        ]);
    }
}
