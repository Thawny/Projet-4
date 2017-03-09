<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 09/03/2017
 * Time: 15:33
 */

namespace AppBundle\OverbookingChecker\OverbookingChecker;

/**
 * Class OverbookingChecker
 */
class OverbookingChecker
{
    private $commandRepository;

    public function __construct(\AppBundle\Repository\CommandRepository $commandRepository)
    {
        $this->commandRepository = $commandRepository;
    }

    public function isOverbooked($dateVisit)
    {
        $counter = 0;

        $commands = $this
            ->commandRepository
            ->findCommandsWithItsVisitors($dateVisit);

//        foreach ($commands->

    }
}