<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusRevisions
 *
 * @ORM\Table(name="directus_revisions")
 * @ORM\Entity
 */
class DirectusRevisions
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
     * @var int
     *
     * @ORM\Column(name="activity", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $activity;

    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=64, nullable=false)
     */
    public $collection;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255, nullable=false)
     */
    public $item;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", length=0, nullable=false)
     */
    public $data;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delta", type="text", length=0, nullable=true)
     */
    public $delta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent_collection", type="string", length=64, nullable=true)
     */
    public $parentCollection;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parent_item", type="string", length=255, nullable=true)
     */
    public $parentItem;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="parent_changed", type="boolean", nullable=true)
     */
    public $parentChanged = '0';


}
