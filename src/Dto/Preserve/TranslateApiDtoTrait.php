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

use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Preserve\CodeDstTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Preserve\CodeSrcTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Preserve\TextDstTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Preserve\TextSrcTrait;

trait TranslateApiDtoTrait
{
    use IdTrait;
    use CodeDstTrait;
    use CodeSrcTrait;
    use TextDstTrait;
    use TextSrcTrait;
}
