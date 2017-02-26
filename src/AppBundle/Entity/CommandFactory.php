<?php


namespace AppBundle\Entity;


use AppBundle\Form\Model\CommandModel;

class CommandFactory
{
    /**
     * @var VisitorFactory
     */
    private $visitorFactory;

    /**
     * @param CommandModel $model
     * @return Command
     */
    public function create(CommandModel $model)
    {
        $command = new Command();
        $command->setEmail($model->getEmail());

//        return new Command();
    }

    /**
     * @param VisitorFactory $visitorFactory
     */
    public function setVisitorFactory($visitorFactory)
    {
        $this->visitorFactory = $visitorFactory;
    }
}
