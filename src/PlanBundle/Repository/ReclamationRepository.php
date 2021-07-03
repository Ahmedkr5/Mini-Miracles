<?php


namespace PlanBundle\Repository;


class ReclamationRepository extends \Doctrine\ORM\EntityRepository
{


    public function readrec($nomGroup)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT r.sujet,r.nomGroup FROM PlanBundle:Reclamation r Where r.nomGroup='$nomGroup' "
            )
            ->getResult();
    }

}