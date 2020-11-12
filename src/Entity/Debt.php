<?php

namespace App\Entity;



use App\Repository\DebtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DebtRepository::class)
 */
class Debt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id = 1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="debts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="debts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creditor;






    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accepted = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finished= false;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $alreadyRefund;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deadline;

    /**
     * @ORM\ManyToMany(targetEntity=User::class)
     */
    private $tempCreditor;

    public function __construct()
    {
        $this->tempCreditor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreditor(): ?User
    {
        return $this->creditor;
    }

    public function setCreditor(?User $creditor): self
    {
        $this->creditor = $creditor;

        return $this;
    }




    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): self
    {
        $this->finished = $finished;

        return $this;
    }

    public function getAlreadyRefund(): ?float
    {
        return $this->alreadyRefund;
    }

    public function setAlreadyRefund(?float $alreadyRefund): self
    {
        $this->alreadyRefund = $alreadyRefund;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getTempCreditor(): Collection
    {
        return $this->tempCreditor;
    }

    public function addTempCreditor(User $tempCreditor): self
    {
        if (!$this->tempCreditor->contains($tempCreditor)) {
            $this->tempCreditor[] = $tempCreditor;
        }

        return $this;
    }

    public function removeTempCreditor(User $tempCreditor): self
    {
        $this->tempCreditor->removeElement($tempCreditor);

        return $this;
    }
}
