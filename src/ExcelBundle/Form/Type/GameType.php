<?php
namespace ExcelBundle\Form\Type;

use ExcelBundle\Entity\Game as GameEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class GameType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
    	$builder->add('userChoice', 'choice', array(
    			'choices' => GameEntity::getChoiceCollection(),
    			'choices_as_values' => false,
    	));
    	$builder->add('play', 'submit', array(
    			'label' => 'Play',
    	));
    	/*
		$builder->add('userChoice', 'choice', array(
        	'choices' => array(0=>'assd', 1=>'fgdf'),
        	'choice_label' => 'choice'
    	));

			
        
        $builder->add('play', 'submit', array(
        	'label' => 'Play',
        	'attr' => array(
        		'class' => 'btn btn-primary'
        	)	
        ));
        */
    }
    

    /**
     * @return string
     */
    public function getName()
    {
        return 'excel_game';
    }
}
