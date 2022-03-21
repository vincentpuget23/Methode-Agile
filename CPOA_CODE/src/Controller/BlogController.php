<?php

namespace App\Controller;

use App\Entity\Hebergeur;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HebergeurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use ContainerOZ7jeUB\getReservationTypeService;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/OpenTennisHome.html.twig');
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('blog/OpenTennisHome.html.twig');
    }



    /**
     * @Route("/hebergements", name="hebergements")
     */
    public function hebergement(HebergeurRepository $hebergeurRepository, UserRepository $userRepository): Response
    {
        return $this->render('blog/hebergement.html.twig', [
            'hebergeurs' => $hebergeurRepository->findAll(),
            'User' => $userRepository->findAll(),
        ]);
    }


    /**
     * @Route("/hebergeur/{id}/reservation", name="reservation")
     */
    public function reservation(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        $id = dump($id);
        $hebergeur = $entityManager->find(Hebergeur::class, $id);
        $nbChamHeber = $hebergeur->getNbChambres();
        $nbChamResa = $reservation->getNbChambres();
        $nbPersonnes = $reservation->getNbPersonnes();
        $nbLits = $hebergeur->getNblits();
        $nbPlaces = $nbLits * $nbChamHeber;


        if ($nbChamHeber > $reservation->getNbChambres()) {

            $hebergeur->setNbChambres($nbChamHeber - $nbChamResa);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setIdHotel($id);


            if ($nbChamHeber >= $reservation->getNbChambres()) {
                if ($nbPlaces > $nbPersonnes) {
                    $hebergeur->setNbChambres($nbChamHeber - $nbChamResa);
                    $reservation->setIdHotel($id);
                    $entityManager->persist($reservation);
                    $entityManager->flush();
                    return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
                } else {
                    echo "Nombre de personnes trop élevé par rapport au nombre de place choisis";
                }
            } else {
                echo "Cet hotel n'a plus de chambres disponible : Il en reste " . $hebergeur->getNbChambres();
            }
        }
        return $this->render('blog/reservation.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView()
        ]);
    }
}
