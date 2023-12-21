<?php

namespace App\Form;

use App\Entity\Books;
use Doctrine\DBAL\Types\TextType;
use PgSql\Lob;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['constraints' => [new Length(min:4, max:50),  new NotBlank(), new Regex(
                pattern: '/^[A-Za-z]*/',
                message: 'Denumirea trebuie sa contina intre 4 si 50 de caractere.'
            )]])
            ->add('author', TextType::class, ['constraints' => [new NotBlank(), new Regex(
                pattern: '/^[A-Za-z]*/',
            )]])
            ->add('price', )
            ->add('description', TextType::class, ['constraints' =>[new Length(min:10, max:200), new NotBlank(), new Regex(
                pattern:'/^[A-Za-z]*/',
                message: 'Descrierea trebuie sa contina intre 10 si 200 de caractere.'
            )]])
            ->add('submit', SubmitType::class, ['label' => 'Save', 'attr' => [ 'class' => 'btn btn-primary']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
