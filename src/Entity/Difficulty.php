<?php

namespace App\Entity;

use App\Repository\DifficultyRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=DifficultyRepository::class)
 * @ApiResource()
 */
class Difficulty
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(
     * min = 1,
     * max = 255,
     * )
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Hiscore::class, mappedBy="difficulty")
     */
    private $hiscores;

    public function __construct()
    {
        $this->hiscores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Hiscore>
     */
    public function getHiscores(): Collection
    {
        return $this->hiscores;
    }

    public function addHiscore(Hiscore $hiscore): self
    {
        if (!$this->hiscores->contains($hiscore)) {
            $this->hiscores[] = $hiscore;
            $hiscore->setDifficulty($this);
        }

        return $this;
    }

    public function removeHiscore(Hiscore $hiscore): self
    {
        if ($this->hiscores->removeElement($hiscore)) {
            // set the owning side to null (unless already changed)
            if ($hiscore->getDifficulty() === $this) {
                $hiscore->setDifficulty(null);
            }
        }

        return $this;
    }
}
