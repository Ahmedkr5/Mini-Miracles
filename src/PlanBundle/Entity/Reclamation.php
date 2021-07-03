<?php

namespace PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_group", columns={"id_group"})})
 * @ORM\Entity(repositoryClass="PlanBundle\Repository\ReclamationRepository")
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreclam", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclam;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet", type="string", length=25, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="nomgroup", type="string", length=25, nullable=false)
     * })
     */
    private $nomGroup;

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




    /**
     * @return int
     */
    public function getIdreclam()
    {
        return $this->idreclam;
    }

    /**
     * @param int $idreclam
     */
    public function setIdreclam($idreclam)
    {
        $this->idreclam = $idreclam;
    }

    /**
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param string $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return mixed
     */



}

