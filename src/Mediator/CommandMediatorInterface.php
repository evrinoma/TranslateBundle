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

namespace Evrinoma\TranslateBundle\Mediator;

use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeCreatedException;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeRemovedException;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeSavedException;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

interface CommandMediatorInterface
{
    /**
     * @param TranslateApiDtoInterface $dto
     * @param TranslateInterface       $entity
     *
     * @return TranslateInterface
     *
     * @throws TranslateCannotBeSavedException
     */
    public function onUpdate(TranslateApiDtoInterface $dto, TranslateInterface $entity): TranslateInterface;

    /**
     * @param TranslateApiDtoInterface $dto
     * @param TranslateInterface       $entity
     *
     * @throws TranslateCannotBeRemovedException
     */
    public function onDelete(TranslateApiDtoInterface $dto, TranslateInterface $entity): void;

    /**
     * @param TranslateApiDtoInterface $dto
     * @param TranslateInterface       $entity
     *
     * @return TranslateInterface
     *
     * @throws TranslateCannotBeSavedException
     * @throws TranslateCannotBeCreatedException
     */
    public function onCreate(TranslateApiDtoInterface $dto, TranslateInterface $entity): TranslateInterface;
}
