<?php

namespace IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="id_is", columns={"id_is"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_comment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idComment;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * @var \Issues
     *
     * @ORM\ManyToOne(targetEntity="Issues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_is", referencedColumnName="id_is")
     * })
     */
    private $idIs;

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
