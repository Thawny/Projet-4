<?php


namespace AppBundle\Entity;


class VisitorFactory
{
    /**
     * @return Visitor
     */
    public function create(VistorModel $vistor){
        return new Visitor();
    }
}
