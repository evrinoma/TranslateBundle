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

namespace Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\TextSrcTrait as TextSrcImmutableTrait;

trait TextSrcTrait
{
    use TextSrcImmutableTrait;

    /**
     * @param string $textSrc
     *
     * @return DtoInterface
     */
    protected function setTextSrc(string $textSrc): DtoInterface
    {
        $this->textSrc = trim($textSrc);

        return $this;
    }
}
