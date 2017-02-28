<?php


namespace AppBundle\Entity;

use AppBundle\Form\Model\VisitorModel;


class VisitorFactory
{
    /**
     * @return Visitor
     */
    public function create(VisitorModel $visitor)
    {
        $visitor_entity = new Visitor();
        $visitor_entity->setFirstName($visitor->getFirstName());
        $visitor_entity->setLastName($visitor->getLastName());
        $visitor_entity->setBirthday($visitor->getBirthday());
        $visitor_entity->setCountry($visitor->getCountry());
        $visitor_entity->setDiscount($visitor->discount);

        return $visitor_entity;


    }
}
