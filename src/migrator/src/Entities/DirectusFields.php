<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusFields
 *
 * @ORM\Table(name="directus_fields", uniqueConstraints={@ORM\UniqueConstraint(name="idx_collection_field", columns={"collection", "field"})})
 * @ORM\Entity
 */
class DirectusFields
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
     * @var string
     *
     * @ORM\Column(name="field", type="string", length=64, nullable=false)
     */
    public $field;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=64, nullable=false)
     */
    public $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="interface", type="string", length=64, nullable=true)
     */
    public $interface;

    /**
     * @var string|null
     *
     * @ORM\Column(name="options", type="text", length=65535, nullable=true)
     */
    public $options;

    /**
     * @var bool
     *
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    public $locked = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="validation", type="string", length=255, nullable=true)
     */
    public $validation;

    /**
     * @var bool
     *
     * @ORM\Column(name="required", type="boolean", nullable=false)
     */
    public $required = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="readonly", type="boolean", nullable=false)
     */
    public $readonly = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="hidden_detail", type="boolean", nullable=false)
     */
    public $hiddenDetail = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="hidden_browse", type="boolean", nullable=false)
     */
    public $hiddenBrowse = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="sort", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $sort;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=false, options={"default"="4","unsigned"=true})
     */
    public $width = '4';

    /**
     * @var int|null
     *
     * @ORM\Column(name="group", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $group;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="string", length=1024, nullable=true)
     */
    public $note;

    /**
     * @var string|null
     *
     * @ORM\Column(name="translation", type="text", length=65535, nullable=true)
     */
    public $translation;


}
