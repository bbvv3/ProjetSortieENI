<?php

namespace App\Form;

use App\Entity\Campus;
use App\Models\Filtres;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

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
                'label_attr' => [
                    'class' => 'col-7'
                ],
                'attr' => [
                    'class' => 'col-5'
                ]
            ])
            ->add('search', SearchType::class, [
                'label' => 'Le nom de la sortie contient : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'search',
                    'class' => 'col-5 rounded-pill px-2'
                ],
                'label_attr' => [
                    'class' => 'col-7'
                ]
            ])
            ->add('dateDebut',DateType::class, [
                'label' => "Entre",
                'required' => false,
                'widget' =>'single_text',
                'attr' =>[
                    'min' =>(new \DateTime())->format('c'),
                ],
                'label_attr' => [
                    'class' => 'pe-4'
                ]
            ])
            ->add('dateFin',DateType::class,[
                'label' => "et",
                'required' => false,
                'widget'=>'single_text',
                'attr'=>[
                    'min'=>(new \DateTime())->format('c')
                ],
                'label_attr' => [
                    'class' => 'pe-4'
                ]
            ])
            ->add('estOrganisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l\'organisateur/trice',
                'required' => false
                ])
            ->add('estInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e',
                'required' => false
                ])
            ->add('pasInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false
                ])
            ->add('estPasse', CheckboxType::class, [
                'label' => 'Sorties pass??es',
                'required' => false
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filtres::class,
        ]);
    }
}
