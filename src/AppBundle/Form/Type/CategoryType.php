<?php


namespace AppBundle\Form\Type;


use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', TextType::class, [
            'label' => 'categorie'
        ])
            ->add('parent', EntityType::class, [
                'class' => 'AppBundle\Entity\Category',
                'placeholder' => 'Choisisez une option',
                'required' => false,
                'choice_label' => 'category'
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class
        ]);
    }
}