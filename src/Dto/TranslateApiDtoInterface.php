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

namespace Evrinoma\TranslateBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\CodeDstInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\CodeSrcInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\TextDstInterface;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Immutable\TextSrcInterface;

interface TranslateApiDtoInterface extends DtoInterface, IdInterface, CodeSrcInterface, CodeDstInterface, TextSrcInterface, TextDstInterface
{
}
