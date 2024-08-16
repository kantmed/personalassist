<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: 'articles')]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $intitule = null;

    public ?float $debit = null;
    public ?float $credit = null;
    public ?float $solde = null;


    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Journal::class)]
    private Collection $journals;

    #[ORM\Column(nullable: true)]
    private ?int $report = null;

    public function __construct()
    {
        $this->journals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $journal->setArticle($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): static
    {
        if ($this->journals->removeElement($journal)) {
            // set the owning side to null (unless already changed)
            if ($journal->getArticle() === $this) {
                $journal->setArticle(null);
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
        return $this->getDebit() - $this->getCredit();
    }


    public function __toString()
    {
        return $this->intitule ?? '';
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getReport(): ?int
    {
        return $this->report;
    }

    public function setReport(?int $report): static
    {
        $this->report = $report;

        return $this;
    }
}
