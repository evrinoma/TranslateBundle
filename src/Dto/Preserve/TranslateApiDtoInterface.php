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

namespace Evrinoma\TranslateBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\CodeDstInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\CodeSrcInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\TextDstInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\TextSrcInterface;

interface TranslateApiDtoInterface extends IdInterface, CodeSrcInterface, CodeDstInterface, TextSrcInterface, TextDstInterface
{
}
