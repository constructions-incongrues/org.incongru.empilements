<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusCollections
 *
 * @ORM\Table(name="directus_collections")
 * @ORM\Entity
 */
class DirectusCollections
{
    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $collection;

    /**
     * @var bool
     *
     * @ORM\Column(name="managed", type="boolean", nullable=false, options={"default"="1"})
     */
    public $managed = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="hidden", type="boolean", nullable=false)
     */
    public $hidden = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="single", type="boolean", nullable=false)
     */
    public $single = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="icon", type="string", length=30, nullable=true)
     */
    public $icon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    public $note;

    /**
     * @var string|null
     *
     * @ORM\Column(name="translation", type="text", length=65535, nullable=true)
     */
    public $translation;


}
