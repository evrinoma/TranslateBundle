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

namespace Evrinoma\TranslateBundle\Repository\Translate;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateNotFoundException;
use Evrinoma\TranslateBundle\Exception\TranslateProxyException;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

interface TranslateQueryRepositoryInterface
{
    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws TranslateNotFoundException
     */
    public function findByCriteria(TranslateApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return TranslateInterface
     *
     * @throws TranslateNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): TranslateInterface;

    /**
     * @param string $id
     *
     * @return TranslateInterface
     *
     * @throws TranslateProxyException
     * @throws ORMException
     */
    public function proxy(string $id): TranslateInterface;
}
