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
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param TranslateApiDtoInterface $dto
     * @param QueryBuilderInterface    $builder
     *
     * @return mixed
     */
    public function createQuery(TranslateApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param TranslateApiDtoInterface $dto
     * @param QueryBuilderInterface    $builder
     *
     * @return array
     */
    public function getResult(TranslateApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
