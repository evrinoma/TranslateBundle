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

trait TextSrcTrait
{
    private string $textSrc = '';

    /**
     * @return bool
     */
    public function hasTextSrc(): bool
    {
        return '' !== $this->textSrc;
    }

    /**
     * @return string
     */
    public function getTextSrc(): string
    {
        return $this->textSrc;
    }
}
