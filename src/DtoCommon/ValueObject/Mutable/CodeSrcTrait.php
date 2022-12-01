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
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\CodeSrcTrait as CodeSrcImmutableTrait;

trait CodeSrcTrait
{
    use CodeSrcImmutableTrait;

    /**
     * @param string $codeSrc
     *
     * @return DtoInterface
     */
    protected function setCodeSrc(string $codeSrc): DtoInterface
    {
        $this->codeSrc = trim($codeSrc);

        return $this;
    }
}
