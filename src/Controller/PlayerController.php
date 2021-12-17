<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlayerRepository;
use App\Entity\Player;
use App\Form\PlayerType;

class PlayerController extends AbstractController
{
    #[Route('/player', name: 'player')]
    public function index(Request $request, PlayerRepository $playerRepository, EntityManagerInterface $entityManager): Response
    {

        $players = $playerRepository->findall();
        $player = new Player();

        $form = $this->createForm(playerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $player = $form->getData();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->renderForm('player/index.html.twig', [
            'form' => $form,
        ]);
    }
}
