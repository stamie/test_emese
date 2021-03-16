<?php

namespace App\Form;


use App\Entity\Modell;
use App\Entity\Furniture;

use PhpParser\Node\Expr\AssignOp\Mod;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AddFurnitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inventory_number', null, [])
            ->add('price')
            ->add('count')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Furniture::class,
        ]);
    }
}
