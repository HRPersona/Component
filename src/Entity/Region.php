<?php

namespace Persona\Hris\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Persona\Hris\Component\Address\Model\RegionInterface;
use Persona\Hris\Util\StringUtil;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="regions", indexes={@ORM\Index(name="regions_idx", columns={"code", "name"})})
 *
 * @ApiResource(
 *     attributes={
 *         "filters"={
 *             "code.search",
 *             "name.search"
 *         },
 *         "normalization_context"={"groups"={"read"}},
 *         "denormalization_context"={"groups"={"write"}}
 *     }
 * )
 *
 * @author Muhamad Surya Iksanudin <surya.iksanudin@hrpersona.id>
 */
class Region implements RegionInterface
{
    /**
     * @Groups({"read", "write"})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     *
     * @var string
     */
    private $id;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=7)
     * @Assert\Length(max=7)
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $code;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return (string) $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = StringUtil::uppercase($code);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = StringUtil::uppercase($name);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s - %s', $this->getCode(), $this->getName());
    }
}
