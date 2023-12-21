<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Books;
use App\Service\BooksService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BooksType;

class BooksController extends AbstractController
{
    #[Route('/books', name: 'app_books')]
    public function index(): Response
    {
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
        ]);
    }
    #[Route('/book/{id}', name: 'app_view_books')]
    public function book_view(Books $book) : Response 
    {
        return $this->render('books/book_view.html.twig', ['book' => $book,]);
        
    }
    #[Route('/book/list', name: 'app_list')]
    public function view_list(Books $books): Response 
    {

        return $this->render('books/books_list.html.twig', ['books' => $books]);     
    }

    #[Route('/book/update/{id}', name: 'app_book_update')]
    public function update(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $book = $entityManager->getRepository(Books::class)->find($id);
        $form = $this->createForm(BooksType::class,  $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $title = $form->get('title')->getData();
            $author = $form->get('author')->getData();
            $price = $form->get('price')->getData();
            $description = $form->get('description')->getData();
            $this->BooksService->editBook($id, $title, $author, $price, $description);

            return $this->redirectToRoute('app_list');
        }

        return $this->render('to_do/index.html.twig', ['book_form' => $form->createView()]);
    }

}
