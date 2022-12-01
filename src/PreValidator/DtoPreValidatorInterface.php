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

namespace Evrinoma\TranslateBundle\PreValidator;

use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @throws TranslateInvalidException
     */
    public function onPost(TranslateApiDtoInterface $dto): void;

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @throws TranslateInvalidException
     */
    public function onPut(TranslateApiDtoInterface $dto): void;

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @throws TranslateInvalidException
     */
    public function onDelete(TranslateApiDtoInterface $dto): void;
}
