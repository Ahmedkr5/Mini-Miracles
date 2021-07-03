<?php

namespace PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="PlanBundle\Repository\GroupRepository")
 */
class Groupe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_group", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_group", type="string", length=25, nullable=false)
     */
    private $nomGroup;

    /**
     * @return int
     */
    public function getIdGroup()
    {
        return $this->idGroup;
    }

    /**
     * @param int $idGroup
     */
    public function setIdGroup($idGroup)
    {
        $this->idGroup = $idGroup;
    }

    /**
     * @return string
     */
    public function getNomGroup()
    {
        return $this->nomGroup;
    }

    /**
     * @param string $nomGroup
     */
    public function setNomGroup($nomGroup)
    {
        $this->nomGroup = $nomGroup;
    }


}
