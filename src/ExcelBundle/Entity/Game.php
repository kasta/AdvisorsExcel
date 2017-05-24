<?php
namespace ExcelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ExcelBundle\Entity\GameRepository")

 */
class Game
{
    const CHOICE_ROCK = 'Rock';
    const CHOICE_PAPER = 'Paper';
    const CHOICE_SCISSORS = 'Scissors';
    const CHOICE_SPOCK = 'Spock';
    const CHOICE_LIZARD = 'Lizard';
    const WINNER_USER = 'User';
    const WINNER_COMPUTER = 'Computer';
    const WINNER_TIE = 'Tie';
    
    public static function getChoiceCollection()
    {
    	$coll = array(
    			self::CHOICE_ROCK,
    			self::CHOICE_PAPER,
    			self::CHOICE_SCISSORS,
    			self::CHOICE_SPOCK,
    			self::CHOICE_LIZARD
    	);
    	return $coll;
    }
    
    public static function getWinnerCollection()
    {
    	$coll = array(
    			self::WINNER_USER,
    			self::WINNER_COMPUTER,
    			self::WINNER_TIE
    	);
    	return $coll;
    }
    
    public static function getRandomChoiceCollectionIndex()
    {
    	$choiceCollection = self::getChoiceCollection();
    	$index = mt_rand(0,count($choiceCollection)-1);
    	return $index;
    }
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="userChoice", type="string", length=255)
     */
    private $userChoice;
    
    /**
     * @var string
     *
     * @ORM\Column(name="computerChoice", type="string", length=255)
     */
    private $computerChoice;

    /**
     * @var string
     *
     * @ORM\Column(name="winner", type="string", length=255)
     */
    private $winner;
    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get userChoice
     *
     * @return string
     */
    public function getUserChoice()
    {
    	return $this->userChoice;
    }
    
    /**
     * Set userChoice
     *
     * @param string $userChoice
     *
     * @return Game
     */
    public function setUserChoice($userChoice)
    {
        $this->userChoice = $userChoice;

        return $this;
    }

    /**
     * Get computerChoice
     *
     * @return string
     */
    public function getComputerChoice()
    {
    	return $this->computerChoice;
    }
    
    /**
     * Set computerChoice
     *
     * @param string $computerChoice
     *
     * @return Game
     */
    public function setComputerChoice($computerChoice)
    {
    	$this->computerChoice = $computerChoice;
    
    	return $this;
    }

    /**
     * Get winner
     *
     * @return string
     */
    public function getWinner()
    {
    	return $this->winner;
    }
    
    /**
     * Set winner
     *
     * @param string $winner
     *
     * @return Game
     */
    public function setWinner($winner)
    {
    	$this->winner = $winner;
    
    	return $this;
    }
    
    public function play($choice1, $choice2)
    {
    	$modulus = ($choice1-$choice2+5)%5;
    	if ($modulus === 0) {
    		return self::WINNER_TIE;
    	} elseif ($modulus ===1 || $modulus === 3) {
    		return self::WINNER_USER;
    	} else {
    		return self::WINNER_COMPUTER;
    	}
    }
}

