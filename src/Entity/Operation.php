<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;

#[ORM\Entity(repositoryClass: OperationRepository::class)]
#[ORM\Table(name: 'operations')]
class Operation
{
    const TYPES = array('صرف' => 0, 'فبض' => 1,   'تحويل' => 2,   'اخر' => 3);

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'operation', targetEntity: Journal::class, cascade: ['persist'])]
    private Collection $journals;

    public ?float $debit = null;
    public ?float $credit = null;
    public ?float $solde = null;

    private ?string $coleur = null;


    public function __construct()
    {
        $this->journals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Journal>
     */
    public function getJournals(): Collection
    {
        return $this->journals;
    }

    public function addJournal(Journal $journal): static
    {
        if (!$this->journals->contains($journal)) {
            $this->journals->add($journal);
            $journal->setOperation($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getOperation() === $this) {
                $journal->setOperation(null);
            }
        }

        return $this;
    }

    public function getDebit(): ?float
    {

        $deb = 0;
        foreach ($this->journals as $jou) {
            $deb += $jou->getDebit();
        }
        return $deb ?? 0;
    }

    public function getCredit(): ?float
    {
        $deb = 0;
        foreach ($this->journals as $jou) {
            $deb += $jou->getCredit();
        }
        return $deb ?? 0;
    }

    public function getSolde(): ?float
    {
        return $this->debit - $this->credit;
    }

    public function getColeur()
    {
        if ($this->getType() == 0) {
            return 'D80032';
        }
        if ($this->getType() == 1) {
            return '0E21A0';
        }
        if ($this->getType() == 2) {
            return '793FDF';
        }
        if ($this->getType() == 3) {
            return 'F94C10';
        }
    }

    public function __toString()
    {
        return $this->numero;
    }
}
