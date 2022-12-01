<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\TranslateBundle\Model\Translate;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="idx_id", columns={"id"})
 * }
 * )
 */
abstract class AbstractTranslate implements TranslateInterface
{
    use IdTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="code_src", type="string", length=255, nullable=false)
     */
    protected string $codeSrc;

    /**
     * @var string
     *
     * @ORM\Column(name="code_dst", type="string", length=255, nullable=false)
     */
    protected string $codeDst;

    /**
     * @var string
     *
     * @ORM\Column(name="text_src_", type="text", nullable=false)
     */
    protected string $textSrc;

    /**
     * @var string
     *
     * @ORM\Column(name="text_dst", type="text", nullable=false)
     */
    protected string $textDst;

    /**
     * @return string
     */
    public function getCodeSrc(): string
    {
        return $this->codeSrc;
    }

    /**
     * @param string $codeSrc
     *
     * @return TranslateInterface
     */
    public function setCodeSrc(string $codeSrc): TranslateInterface
    {
        $this->codeSrc = $codeSrc;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodeDst(): string
    {
        return $this->codeDst;
    }

    /**
     * @param string $codeDst
     *
     * @return TranslateInterface
     */
    public function setCodeDst(string $codeDst): TranslateInterface
    {
        $this->codeDst = $codeDst;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextSrc(): string
    {
        return $this->textSrc;
    }

    /**
     * @param string $textSrc
     *
     * @return TranslateInterface
     */
    public function setTextSrc(string $textSrc): TranslateInterface
    {
        $this->textSrc = $textSrc;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextDst(): string
    {
        return $this->textDst;
    }

    /**
     * @param string $textDst
     *
     * @return TranslateInterface
     */
    public function setTextDst(string $textDst): TranslateInterface
    {
        $this->textDst = $textDst;

        return $this;
    }
}
