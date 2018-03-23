<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Notes;
use App\Common\Database;
use App\Form\NoteType;

class AdminController extends Controller
{
	/**
     * @Route("/manage/edit/{id}", name="edit_notes", requirements={"number"="\d+"})
     */
    public function editNote(Request $request,Database $database,$id = null)
    {
        // crée une tâche et lui donne quelques données par défaut pour cet exemple
        $submitText = "Save";
        $em = $this->getDoctrine()->getManager();

        if(is_null($id))
        {
           $note = new Notes();
           $note->setDate(new \DateTime('today'));

        }else
        {
            $note = $em->getRepository(Notes::class)->find($id);
            $submitText = "update";
        }

       

        $form = $this->createForm(NoteType::class, $note, array('submitText'=>$submitText));

        /*$this->createFormBuilder($note)
            ->add('title', TextType::class,array('attr' => array('placeholder' => "Titre de l affiche")))
                ->add('date', DateType::class)
                ->add('img', TextType::class , array('required' => false , 'attr' => array('placeholder' => "URL de l'image")))
                ->add('text', TextareaType::class, array('attr' => array('placeholder' => 'Texte html')))
                ->add($submitText, SubmitType::class)
                ->getForm();*/

        $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $note = $form->getData();
                    $em->persist($note);
                    $em->flush();
                    //return $this->redirect($this->generateUrl('task_success'));
                }

        $notes = $database->getNotes();

        return $this->render('admin/edit_note.html.twig', array(
            'form' => $form->createView(),
            'notes' => $notes,
            'message' => null,
        ));
    }

    /**
     * @Route("/manage/delete/{id}", name="delete_note")
     */
    public function deleteNote(Database $database,$id)
    {
    	return null;
    }

}
