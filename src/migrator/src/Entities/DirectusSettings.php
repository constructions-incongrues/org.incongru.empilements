<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusSettings
 *
 * @ORM\Table(name="directus_settings", uniqueConstraints={@ORM\UniqueConstraint(name="idx_key", columns={"key"})})
 * @ORM\Entity
 */
class DirectusSettings
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=64, nullable=false)
     */
    public $key;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, nullable=false)
     */
    public $value;


}
