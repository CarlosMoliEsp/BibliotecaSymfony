<?php

namespace App\Controller;

use App\Entity\Libros;
use App\Form\LibrosType;
use App\Repository\LibrosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/libros')]
class LibrosController extends AbstractController
{
    #[Route('/', name: 'app_libros_index', methods: ['GET'])]
    public function index(LibrosRepository $librosRepository): Response
    {
        return $this->render('libros/index.html.twig', [
            'libros' => $librosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_libros_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LibrosRepository $librosRepository): Response
    {
        $libro = new Libros();
        $form = $this->createForm(LibrosType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $librosRepository->save($libro, true);

            return $this->redirectToRoute('app_libros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('libros/new.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_libros_show', methods: ['GET'])]
    public function show(Libros $libro): Response
    {
        return $this->render('libros/show.html.twig', [
            'libro' => $libro,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_libros_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Libros $libro, LibrosRepository $librosRepository): Response
    {
        $form = $this->createForm(LibrosType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $librosRepository->save($libro, true);

            return $this->redirectToRoute('app_libros_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('libros/edit.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_libros_delete', methods: ['POST'])]
    public function delete(Request $request, Libros $libro, LibrosRepository $librosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$libro->getId(), $request->request->get('_token'))) {
            $librosRepository->remove($libro, true);
        }

        return $this->redirectToRoute('app_libros_index', [], Response::HTTP_SEE_OTHER);
    }
}
