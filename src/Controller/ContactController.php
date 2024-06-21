<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\MarqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer, MarqueRepository $marqueRepository): Response
    {

        $marques = $marqueRepository->findAll();

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $email = (new Email())
                ->from($contact['email'])
                ->to('mailtrap@example.com')
                ->subject($contact['sujet'])
                ->text('Nom: ' . $contact['nom'] . ', Immatriculation: ' . $contact['immatriculation'] . ', Message: ' . $contact['message'])
                ->replyTo('mailtrap@example.com')
                ->html($contact['message']);

            try {
                $mailer->send($email);
            } catch (\Exception $e) {
                // Add a debugging statement
                dd('Error lors de l\'evoie de l\' email: ' . $e->getMessage());
            }

            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            'marques' => $marques
        ]);
    }
}
