<?php

namespace ExcelBundle\Controller;

use ExcelBundle\Entity\Game;
use ExcelBundle\Form\Type\GameType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ExcelController extends Controller
{
    /**
     * @Route("/game", name="excel_game")
     * @Template()
     */
    public function gameAction(Request $request)
    {        
        $game = new Game();
        $gameForm = $this->createForm(new GameType(), $game);
        
        
        if ($request->isMethod('POST')) {
        	$gameForm->handleRequest($request);
        	if ($gameForm->isValid()) {
        		//User's choice
        		$game = $gameForm->getData();
        		$userChoice = $game->getUserChoice();
				//Computers choice
        		$computerChoice = $game->getRandomChoiceCollectionIndex();
        		$game->setComputerChoice($computerChoice);
				//Play
				$winner = $game->play($userChoice, $computerChoice);
				$game->setWinner($winner);

        		//Persist game        		
        		$em = $this->getDoctrine()->getManager();
        		$em->persist($game);
        		$em->flush();
        
        		//set flash messages
        		$message = 'Computer chooses: '.$game->getChoiceCollection()[$game->getComputerChoice()];
        		$this->get('session')->getFlashBag()->add('message', $message);
        		$message = 'Winner: '.$game->getWinner();
        		$this->get('session')->getFlashBag()->add('message', $message);
           	}
        }
        
        return array(
        		'form' => $gameForm->createView(),
        ); 

    }
}
