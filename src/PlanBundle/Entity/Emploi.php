<?php

namespace PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emploi
 *
 * @ORM\Table(name="emploi", indexes={@ORM\Index(name="id_group", columns={"id_group"}), @ORM\Index(name="id_salle", columns={"id_salle"}), @ORM\Index(name="jour", columns={"jour"})})
 * @ORM\Entity(repositoryClass="PlanBundle\Repository\EmploiRepository")
 */
class Emploi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idemp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idemp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seance_matin", type="boolean", nullable=false)
     */
    private $seanceMatin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seance_soir", type="boolean", nullable=false)
     */
    private $seanceSoir;

    /**

     *
     * @ORM\ManyToOne(targetEntity="Salles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_salle", referencedColumnName="num_salle")
     * })
     */
    private $idSalle;

    /**

     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_group", referencedColumnName="id_group")
     * })
     */
    private $idGroup;

    /**

     *
     * @ORM\ManyToOne(targetEntity="Jour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jour", referencedColumnName="id")
     * })
     */
    private $jour;

    /**
     * @return int
     */
    public function getIdemp()
    {
        return $this->idemp;
    }

    /**
     * @param int $idemp
     */
    public function setIdemp($idemp)
    {
        $this->idemp = $idemp;
    }

    /**
     * @return bool
     */
    public function isSeanceMatin()
    {
        return $this->seanceMatin;
    }

    /**
     * @param bool $seanceMatin
     */
    public function setSeanceMatin($seanceMatin)
    {
        $this->seanceMatin = $seanceMatin;
    }

    /**
     * @return bool
     */
    public function isSeanceSoir()
    {
        return $this->seanceSoir;
    }

    /**
     * @param bool $seanceSoir
     */
    public function setSeanceSoir($seanceSoir)
    {
        $this->seanceSoir = $seanceSoir;
    }

    /**
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param mixed $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }

    /**
     * @return mixed
     */
    public function getIdGroup()
    {
        return $this->idGroup;
    }

    /**
     * @param mixed $idGroup
     */
    public function setIdGroup($idGroup)
    {
        $this->idGroup = $idGroup;
    }

    /**
     * @return mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }



    /**
     * Get seanceMatin
     *
     * @return boolean
     */
    public function getSeanceMatin()
    {
        return $this->seanceMatin;
    }

    /**
     * Get seanceSoir
     *
     * @return boolean
     */
    public function getSeanceSoir()
    {
        return $this->seanceSoir;
    }
}
