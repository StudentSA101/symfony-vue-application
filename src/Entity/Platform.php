<?php

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatformRepository::class)
 */
class Platform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Bundle::class, mappedBy="platform")
     */
    private $bundles;

    public function __construct()
    {
        $this->bundles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Bundle[]
     */
    public function getBundles(): Collection
    {
        return $this->bundles;
    }

    public function addBundle(Bundle $bundle): self
    {
        if (!$this->bundles->contains($bundle)) {
            $this->bundles[] = $bundle;
            $bundle->setPlatform($this);
        }

        return $this;
    }

    public function removeBundle(Bundle $bundle): self
    {
        if ($this->bundles->contains($bundle)) {
            $this->bundles->removeElement($bundle);
            // set the owning side to null (unless already changed)
            if ($bundle->getPlatform() === $this) {
                $bundle->setPlatform(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->getName();
    }
}
