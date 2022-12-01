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

interface TextSrcInterface
{
    /**
     * @param string $textSrc
     *
     * @return DtoInterface
     */
    public function setTextSrc(string $textSrc): DtoInterface;
}
