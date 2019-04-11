<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusRelations
 *
 * @ORM\Table(name="directus_relations")
 * @ORM\Entity
 */
class DirectusRelations
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
     * @ORM\Column(name="collection_many", type="string", length=64, nullable=false)
     */
    public $collectionMany;

    /**
     * @var string
     *
     * @ORM\Column(name="field_many", type="string", length=45, nullable=false)
     */
    public $fieldMany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="collection_one", type="string", length=64, nullable=true)
     */
    public $collectionOne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_one", type="string", length=64, nullable=true)
     */
    public $fieldOne;

    /**
     * @var string|null
     *
     * @ORM\Column(name="junction_field", type="string", length=64, nullable=true)
     */
    public $junctionField;


}
