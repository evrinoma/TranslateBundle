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

trait CodeDstTrait
{
    private string $codeDst = '';

    /**
     * @return bool
     */
    public function hasCodeDst(): bool
    {
        return '' !== $this->codeDst;
    }

    /**
     * @return string
     */
    public function getCodeDst(): string
    {
        return $this->codeDst;
    }
}
