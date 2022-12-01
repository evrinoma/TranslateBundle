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

trait TextDstTrait
{
    private string $textDst = '';

    public function hasTextDst(): bool
    {
        return '' !== $this->textDst;
    }

    /**
     * @return string
     */
    public function getTextDst(): string
    {
        return $this->textDst;
    }
}
