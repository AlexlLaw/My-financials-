<?php

namespace App\Entity;

use App\Repository\DispesasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DispesasRepository::class)
 */
class Dispesas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string")
     */
    private $data;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fixa;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getFixa(): ?bool
    {
        return $this->fixa;
    }

    public function setFixa(bool $fixa): self
    {
        $this->fixa = $fixa;

        return $this;
    }

    public function getTempo(): ?int
    {
        return $this->tempo;
    }

    public function setTempo(int $tempo): self
    {
        $this->tempo = $tempo;

        return $this;
    }
}
