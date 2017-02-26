<?php


namespace AppBundle\Entity;

use AppBundle\Form\Model\VisitorModel;


class VisitorFactory
{
    /**
     * @return Visitor
     */
    public function create(VisitorModel $visitor){
        return new Visitor();
    }
}
