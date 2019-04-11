<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusPermissions
 *
 * @ORM\Table(name="directus_permissions")
 * @ORM\Entity
 */
class DirectusPermissions
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
     * @ORM\Column(name="collection", type="string", length=64, nullable=false)
     */
    public $collection;

    /**
     * @var int
     *
     * @ORM\Column(name="role", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=64, nullable=true)
     */
    public $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="create", type="string", length=16, nullable=true, options={"default"="none"})
     */
    public $create = 'none';

    /**
     * @var string|null
     *
     * @ORM\Column(name="read", type="string", length=16, nullable=true, options={"default"="none"})
     */
    public $read = 'none';

    /**
     * @var string|null
     *
     * @ORM\Column(name="update", type="string", length=16, nullable=true, options={"default"="none"})
     */
    public $update = 'none';

    /**
     * @var string|null
     *
     * @ORM\Column(name="delete", type="string", length=16, nullable=true, options={"default"="none"})
     */
    public $delete = 'none';

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="string", length=8, nullable=true, options={"default"="none"})
     */
    public $comment = 'none';

    /**
     * @var string|null
     *
     * @ORM\Column(name="explain", type="string", length=8, nullable=true, options={"default"="none"})
     */
    public $explain = 'none';

    /**
     * @var string|null
     *
     * @ORM\Column(name="read_field_blacklist", type="string", length=1000, nullable=true)
     */
    public $readFieldBlacklist;

    /**
     * @var string|null
     *
     * @ORM\Column(name="write_field_blacklist", type="string", length=1000, nullable=true)
     */
    public $writeFieldBlacklist;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status_blacklist", type="string", length=1000, nullable=true)
     */
    public $statusBlacklist;


}
