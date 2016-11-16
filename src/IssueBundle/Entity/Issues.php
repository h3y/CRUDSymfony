<?php

namespace IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issues
 *
 * @ORM\Table(name="issues", indexes={@ORM\Index(name="id_is", columns={"id_is"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Issues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_is", type="integer", nullable=false)
     */
    private $idIs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_post", type="datetime", nullable=false)
     */
    private $datePost;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;


}
