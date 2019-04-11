<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusFiles
 *
 * @ORM\Table(name="directus_files")
 * @ORM\Entity
 */
class DirectusFiles
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
     * @ORM\Column(name="storage", type="string", length=50, nullable=false, options={"default"="local"})
     */
    public $storage = 'local';

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=false)
     */
    public $filename;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    public $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    public $type;

    /**
     * @var int
     *
     * @ORM\Column(name="uploaded_by", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $uploadedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploaded_on", type="datetime", nullable=false)
     */
    public $uploadedOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="charset", type="string", length=50, nullable=true)
     */
    public $charset;

    /**
     * @var int
     *
     * @ORM\Column(name="filesize", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $filesize = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="width", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $width;

    /**
     * @var int|null
     *
     * @ORM\Column(name="height", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $height;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    public $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="embed", type="string", length=200, nullable=true)
     */
    public $embed;

    /**
     * @var int|null
     *
     * @ORM\Column(name="folder", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $folder;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    public $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="location", type="string", length=200, nullable=true)
     */
    public $location;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    public $tags;

    /**
     * @var string|null
     *
     * @ORM\Column(name="checksum", type="string", length=32, nullable=true)
     */
    public $checksum;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metadata", type="text", length=65535, nullable=true)
     */
    public $metadata;

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setChecksum($checksum)
    {
        $this->checksum = $checksum;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    public function setFilesize(int $filesize)
    {
        $this->filesize = $filesize;
    }

    public function setUploadedBy(int $id)
    {
        $this->uploadedBy = $id;
    }

    public function setUploadedOn(\DateTime $date)
    {
        $this->uploadedOn = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFilename()
    {
        return $this->getFilename();
    }
}
