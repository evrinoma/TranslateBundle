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

namespace Evrinoma\TranslateBundle\Manager;

use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateNotFoundException;
use Evrinoma\TranslateBundle\Exception\TranslateProxyException;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

interface QueryManagerInterface
{
    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws TranslateNotFoundException
     */
    public function criteria(TranslateApiDtoInterface $dto): array;

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateNotFoundException
     */
    public function get(TranslateApiDtoInterface $dto): TranslateInterface;

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateProxyException
     */
    public function proxy(TranslateApiDtoInterface $dto): TranslateInterface;
}
