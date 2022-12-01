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

namespace Evrinoma\TranslateBundle\Factory;

use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

interface TranslateFactoryInterface
{
    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     */
    public function create(TranslateApiDtoInterface $dto): TranslateInterface;
}
