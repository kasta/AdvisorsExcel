<?php
namespace ExcelBundle\Form\Type;

use ExcelBundle\Entity\Game as Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
    	$builder->add('userChoice', 'choice', array(
    			'choices' => Game::getChoiceCollection(),
    			'choices_as_values' => false,
    	));
    	$builder->add('play', 'submit', array(
    			'label' => 'Play',
    	));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'excel_game';
    }
}
