<?php 


namespace App\Service;

use App\Entity\Books;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class BooksService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createBook($title, $description, $author, $price): Books
        {
            $book = new Books();
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setPrice($price);
            $book->setDescription($description);
            

            $this->entityManager->persist($book);
            $this->entityManager->flush();

            return $book;
        }
}



?>