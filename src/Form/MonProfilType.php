<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participant;
use ContainerL9RxIeP\getCampusRepositoryService;
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
            ->add('pseudo')
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('mail')
            ->add('motPasse',RepeatedType::class,[
                'mapped'=>false,
                'first_options'  => ['label' => 'motPasse'],
                'second_options' => ['label' => 'confirmation'],
                'constraints'=>[
                    new NotBlank([
                        'message'=>'ce champ doit être remplit',
                    ])
                 ]
            ])
            ->add('campus',EntityType::class,[
                    'class'=>Campus::class,
                    'choice_label'=>'nom',
                    'disabled' => true

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
