<?php

namespace App\Entity;

use App\Repository\DispoAhRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DispoAhRepository::class)
 */
class DispoAh
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */


    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="DispoAhs")
     */
    private $refto_med_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $all_day;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReftoMedId(): ?Medecin
    {
        return $this->refto_med_id;
    }

    public function setReftoMedId(?Medecin $refto_med_id): self
    {
        $this->refto_med_id = $refto_med_id;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getDescp(): ?string
    {
        return $this->descp;
    }

    public function setDescp(string $descp): self
    {
        $this->descp = $descp;

        return $this;
    }

    public function getAllDay(): ?bool
    {
        return $this->all_day;
    }

    public function setAllDay(bool $all_day): self
    {
        $this->all_day = $all_day;

        return $this;
    }
}
