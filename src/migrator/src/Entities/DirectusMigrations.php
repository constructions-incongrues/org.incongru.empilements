<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusMigrations
 *
 * @ORM\Table(name="directus_migrations")
 * @ORM\Entity
 */
class DirectusMigrations
{
    /**
     * @var int
     *
     * @ORM\Column(name="version", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $version;

    /**
     * @var string|null
     *
     * @ORM\Column(name="migration_name", type="string", length=100, nullable=true)
     */
    public $migrationName;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=true)
     */
    public $startTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true)
     */
    public $endTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="breakpoint", type="boolean", nullable=false)
     */
    public $breakpoint = '0';


}
