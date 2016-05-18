<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('detailLink')
            ->add('image', FileType::class)
            ->add('book', FileType::class)
	        ->add('mime', ChoiceType::class, [
		        'choices'  => [
			        'PDF' => 'application/pdf',
			        'Kindle' => 'application/vnd.amazon.ebook',
			        'EPUB' => 'application/x-dtbook+xml',
		        ],
            ])
            ->add('lang')
            ->add('form')
            ->add('tags')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Book'
        ));
    }
}
