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
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeRemovedException;
use Evrinoma\TranslateBundle\Exception\TranslateInvalidException;
use Evrinoma\TranslateBundle\Exception\TranslateNotFoundException;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

interface CommandManagerInterface
{
    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateInvalidException
     */
    public function post(TranslateApiDtoInterface $dto): TranslateInterface;

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateInvalidException
     * @throws TranslateNotFoundException
     */
    public function put(TranslateApiDtoInterface $dto): TranslateInterface;

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @throws TranslateCannotBeRemovedException
     * @throws TranslateNotFoundException
     */
    public function delete(TranslateApiDtoInterface $dto): void;
}
