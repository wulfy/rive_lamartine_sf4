<?php

namespace App\Controller\Admin;

use App\Common\Database;
use App\Entity\Notes;
use App\Form\NoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/manage/edit/{id}', name: 'edit_notes', requirements: ['id' => '\d+'])]
    public function editNote(Request $request, Database $database, EntityManagerInterface $em, ?int $id = null): Response
    {
        $submitText = 'Save';

        if ($id === null) {
            $note = new Notes();
            $note->setDate(new \DateTime('today'));
        } else {
            $note = $em->getRepository(Notes::class)->find($id);
            if (!$note) {
                throw $this->createNotFoundException("Note $id introuvable.");
            }
            $submitText = 'update';
        }

        $form = $this->createForm(NoteType::class, $note, ['submitText' => $submitText]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $em->persist($note);
            $em->flush();
        }

        $notes = $database->getNotes();

        return $this->render('admin/edit_note.html.twig', [
            'form' => $form,
            'notes' => $notes,
            'message' => null,
        ]);
    }

    #[Route('/manage/delete/{id}', name: 'delete_note')]
    public function deleteNote(Database $database, int $id): Response
    {
        return $this->redirectToRoute('edit_notes');
    }
}
