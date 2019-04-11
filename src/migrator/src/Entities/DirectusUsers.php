<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusUsers
 *
 * @ORM\Table(name="directus_users", uniqueConstraints={@ORM\UniqueConstraint(name="idx_users_email", columns={"email"}), @ORM\UniqueConstraint(name="idx_users_external_id", columns={"external_id"}), @ORM\UniqueConstraint(name="idx_users_token", columns={"token"})})
 * @ORM\Entity
 */
class DirectusUsers
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
     * @ORM\Column(name="status", type="string", length=16, nullable=false, options={"default"="draft"})
     */
    public $status = 'draft';

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=true)
     */
    public $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=true)
     */
    public $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     */
    public $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    public $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    public $token;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=32, nullable=false, options={"default"="Europe/Paris"})
     */
    public $timezone = 'Europe/Paris';

    /**
     * @var string|null
     *
     * @ORM\Column(name="locale", type="string", length=8, nullable=true, options={"default"="en-US"})
     */
    public $locale = 'en-US';

    /**
     * @var string|null
     *
     * @ORM\Column(name="locale_options", type="text", length=65535, nullable=true)
     */
    public $localeOptions;

    /**
     * @var int|null
     *
     * @ORM\Column(name="avatar", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $avatar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="company", type="string", length=191, nullable=true)
     */
    public $company;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=191, nullable=true)
     */
    public $title;

    /**
     * @var int
     *
     * @ORM\Column(name="email_notifications", type="integer", nullable=false, options={"default"="1"})
     */
    public $emailNotifications = '1';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_access_on", type="datetime", nullable=true)
     */
    public $lastAccessOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_page", type="string", length=192, nullable=true)
     */
    public $lastPage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="external_id", type="string", length=255, nullable=true)
     */
    public $externalId;


}
