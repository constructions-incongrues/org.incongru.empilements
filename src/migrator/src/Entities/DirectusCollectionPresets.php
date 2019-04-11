<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusCollectionPresets
 *
 * @ORM\Table(name="directus_collection_presets", uniqueConstraints={@ORM\UniqueConstraint(name="idx_user_collection_title", columns={"user", "collection", "title"})})
 * @ORM\Entity
 */
class DirectusCollectionPresets
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
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    public $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $user;

    /**
     * @var int|null
     *
     * @ORM\Column(name="role", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $role;

    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=64, nullable=false)
     */
    public $collection;

    /**
     * @var string|null
     *
     * @ORM\Column(name="search_query", type="string", length=100, nullable=true)
     */
    public $searchQuery;

    /**
     * @var string|null
     *
     * @ORM\Column(name="filters", type="text", length=65535, nullable=true)
     */
    public $filters;

    /**
     * @var string
     *
     * @ORM\Column(name="view_type", type="string", length=100, nullable=false, options={"default"="tabular"})
     */
    public $viewType = 'tabular';

    /**
     * @var string|null
     *
     * @ORM\Column(name="view_query", type="text", length=65535, nullable=true)
     */
    public $viewQuery;

    /**
     * @var string|null
     *
     * @ORM\Column(name="view_options", type="text", length=65535, nullable=true)
     */
    public $viewOptions;

    /**
     * @var string|null
     *
     * @ORM\Column(name="translation", type="text", length=65535, nullable=true)
     */
    public $translation;


}
