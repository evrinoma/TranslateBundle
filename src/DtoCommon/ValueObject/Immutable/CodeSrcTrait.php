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

namespace Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable;

trait CodeSrcTrait
{
    private string $codeSrc = '';

    /**
     * @return bool
     */
    public function hasCodeSrc(): bool
    {
        return '' !== $this->codeSrc;
    }

    /**
     * @return string
     */
    public function getCodeSrc(): string
    {
        return $this->codeSrc;
    }
}
