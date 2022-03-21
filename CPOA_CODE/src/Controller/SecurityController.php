<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\Entity\Users;
use App\Repository\UserRepository;
use App\Repository\HebergeurRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hebergeur;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, ReservationRepository $reservationRepository, HebergeurRepository $hebergeurRepository, UserRepository $userRepository): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'reservations' => $reservationRepository->findAll(),
            'hebergeurs' => $hebergeurRepository->findAll(),
            'User' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }



    /**
     * @Route("/login/delete/{id}", name="reservation_delete")
     */

    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager, $id): Response
    {
        //$idHebergeur = $reservation->getIdHotel();
        $entityManager->remove($reservation);
        $entityManager->flush();
        //$hebergeur = $entityManager->find(Hebergeur::class, $idHebergeur);
        //$nbCham = $hebergeur->getNbChambres();
        //$nbChamReservation = $reservation->getNbChambres();
        //$hebergeur->setNbChambres($nbCham + $nbChamReservation);
        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }
}
