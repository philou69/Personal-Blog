<?php


namespace AppBundle\Form\Type;


use AppBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class EditCategoryType extends CategoryType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = $builder->getData();

        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub

        // On redefinie parent pour ne pas selectionner l'entity comme parent
        $builder->add('parent', EntityType::class, [
            'class' => 'AppBundle\Entity\Category',
            'query_builder' => function(CategoryRepository $categoryRepository) use( $category){
                return $categoryRepository->findOther($category->getSlug());
            },
            'placeholder' => 'Choisisez une option',
            'required' => false,
            'choice_label' => 'category'
        ]);
    }
}