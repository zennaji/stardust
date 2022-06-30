<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Repository\RoomRepository;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    // public $roomRepository;
    // private $entityManager;
    // public function __construct($id, RoomRepository $roomRepository)
    // {
    //     $this->roomRepository = $roomRepository;
    //     // $this->entityManager = $doctrine->getManager();
    // }
    // public function getRoom($id)
    // {
    //     return $this->roomRepository->find($id);
    // }



    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        $locale = $options['current_locale'];
        $builder

            // ->add('name', TextType::class, [
            //     'label' => 'Name',
            //     'attr' => [
            //         'value' => $options['current_locale'],
            //         'class' => 'form-control',
            //     ],
            // ])
            ->add('email')
            ->add('phone')
            // ->add('days', NumberType::class, [
            //     'label' => 'Days',

            // ])
            // ->add('total')
            // ->add('created_at')
            // ->add('updated_at')
            ->add('check_in', DateType::class, [
                'label' => 'Check In',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('check_out', DateType::class, [
                'label' => 'Check out',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            // ->add('room', TextType::class, [

            //     'attr' => ['class' => 'text-editor', 'id' => '...', 'value' => $options['current_locale']],
            // ])
            // ->add('user')
            // ->add('status', ChoiceType::class, [
            //     'choices' => [
            //         'Pending' => 'pending',
            //         'Confirmed' => 'confirmed',
            //         'Cancelled' => 'cancelled',
            //     ],
            // ])
            ->add('Reserveer', SubmitType::class);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'current_locale' => null,
        ]);
    }
}
