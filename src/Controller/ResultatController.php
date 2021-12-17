<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultatController extends AbstractController
{
    #[Route('/resultat', name: 'resultat')]
    public function index(Request $request, PlayerRepository $playerRepository ): Response
    {

        $tabPlayer = $playerRepository->findAll();


        $nbTab = count($tabPlayer);

        $tabResult = [];

        for ($i = 0; $i <= $nbTab-1 ; $i++) {
            for ($j = 0; $j <= $nbTab-1 ; $j++) {
                for ($l = 0; $l <= $nbTab-1 ; $l++) {
                    if($i != $j && $i != $l && $j != $l){

                        $tab = [$tabPlayer[$i]->getPrenom() ." ". $tabPlayer[$i]->getNom(),$tabPlayer[$j]->getPrenom() ." ". $tabPlayer[$j]->getNom(),$tabPlayer[$l]->getPrenom() ." ". $tabPlayer[$l]->getNom()];
                        if(count($tabResult) == 0){
                            $tabResult[]= $tab;
                        }
                        $ocurent = false;
                        foreach ($tabResult as $element){
                            if(in_array($tabPlayer[$i]->getPrenom() ." ". $tabPlayer[$i]->getNom(),$element) && in_array($tabPlayer[$j]->getPrenom() ." ". $tabPlayer[$j]->getNom(),$element) && in_array($tabPlayer[$l]->getPrenom() ." ". $tabPlayer[$l]->getNom(),$element)){
                                $ocurent = true;
                            }
                        }
                        if(!$ocurent){
                            $tabResult[]= $tab;
                        }

                    }
                }
            }
        }

        shuffle($tabResult);

            return $this->render('resultat/index.html.twig', [
                'team1' => $tabResult,
                'team2' => [],
            ]);

        }

}
