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

interface TextDstInterface
{
    public const TEXT_DST = 'text_dst';

    /**
     * @return bool
     */
    public function hasTextDst(): bool;

    /**
     * @return string
     */
    public function getTextDst(): string;
}
