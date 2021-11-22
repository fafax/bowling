<?php

namespace App\Controller;

use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeletePlayerController extends AbstractController
{
    #[Route('/delete/player/{id}', name: 'delete_player')]
    public function index(Player $player, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($player);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
