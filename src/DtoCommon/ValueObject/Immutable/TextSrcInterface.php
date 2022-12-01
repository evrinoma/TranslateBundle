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

interface TextSrcInterface
{
    public const TEXT_SRC = 'text_src';

    /**
     * @return bool
     */
    public function hasTextSrc(): bool;

    /**
     * @return string
     */
    public function getTextSrc(): string;
}
