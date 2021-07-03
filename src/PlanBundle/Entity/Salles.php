<?php

namespace PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salles
 *
 * @ORM\Table(name="salles")
 * @ORM\Entity(repositoryClass="PlanBundle\Repository\SallesRepository")
 */
class Salles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="num_salle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_salle", type="string", length=8, nullable=false)
     *@ORM\OrderBy({"order" = "DESC", "id" = "DESC"})
     */
    private $nomSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="capacite", type="string", length=11, nullable=false)
     */
    private $capacite;

    /**
     * @return int
     */
    public function getNumSalle()
    {
        return $this->numSalle;
    }

    /**
     * @param int $numSalle
     */
    public function setNumSalle($numSalle)
    {
        $this->numSalle = $numSalle;
    }

    /**
     * @return string
     */
    public function getNomSalle()
    {
        return $this->nomSalle;
    }

    /**
     * @param string $nomSalle
     */
    public function setNomSalle($nomSalle)
    {
        $this->nomSalle = $nomSalle;
    }

    /**
     * @return string
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param string $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
    }


}
