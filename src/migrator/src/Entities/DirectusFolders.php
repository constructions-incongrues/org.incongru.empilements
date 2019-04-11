<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusFolders
 *
 * @ORM\Table(name="directus_folders", uniqueConstraints={@ORM\UniqueConstraint(name="idx_name_parent_folder", columns={"name", "parent_folder"})})
 * @ORM\Entity
 */
class DirectusFolders
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
     * @ORM\Column(name="name", type="string", length=191, nullable=false)
     */
    public $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="parent_folder", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $parentFolder;


}
