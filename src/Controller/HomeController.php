<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, MailerInterface $mailer, MarqueRepository $marqueRepository, PromotionRepository $promotionRepository, CategorieRepository $categorieRepository): Response
    {

        $categories = $categorieRepository->findAll();
        $promotions = $promotionRepository->findLastTwoPromotions();
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
        }


        return $this->render('home/home.html.twig', [
            'promotions' => $promotions,
            'marques' => $marques,
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }
}
