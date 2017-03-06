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
        $command->setDateVisit($model->getDateVisit());
        $command->setFullDayTickets(($model->fullDayTickets));
        foreach ($model->getVisitors() as $visitor)
        {
           $visior_entity = $this->getVisitorFactory()->create($visitor);
           $command->addVisitor($visior_entity);
        }


        return $command;


    }

    /**
     * @param VisitorFactory $visitorFactory
     */
    public function setVisitorFactory($visitorFactory)
    {
        $this->visitorFactory = $visitorFactory;
    }

    /**
     * @return VisitorFactory
     */
    public function getVisitorFactory()
    {
        return $this->visitorFactory;
    }
}
