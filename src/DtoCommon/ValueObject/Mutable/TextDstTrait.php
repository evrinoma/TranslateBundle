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
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\TextDstTrait as TextDstImmutableTrait;

trait TextDstTrait
{
    use TextDstImmutableTrait;

    /**
     * @param string $textDst
     *
     * @return DtoInterface
     */
    protected function setTextDst(string $textDst): DtoInterface
    {
        $this->textDst = trim($textDst);

        return $this;
    }
}
