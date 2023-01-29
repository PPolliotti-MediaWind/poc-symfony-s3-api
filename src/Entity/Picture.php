<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PictureRepository;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[Vich\Uploadable()]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[JMS\Groups(['full'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[JMS\Groups(['full'])]
    private ?string $name = null;

    #[JMS\Exclude()]
    #[Vich\UploadableField(mapping: "pictures", fileNameProperty: "pictureName")]
    private ?File $pictureFile;

    #[ORM\Column(length: 255)]
    #[JMS\Groups(['full'])]
    #[JMS\SerializedName("picture")]
    private ?string $pictureName = null;

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

    public function getPictureFile() : ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File|UploadedFile
     */
    public function setPictureFile(?File $pictureFile): self
    {
        $this->pictureFile = $pictureFile;

        return $this;
    }

    public function getPictureName(): ?string
    {
        return $this->pictureName;
    }

    public function setPictureName(?string $pictureName): self
    {
        $this->pictureName = $pictureName;

        return $this;
    }
}
