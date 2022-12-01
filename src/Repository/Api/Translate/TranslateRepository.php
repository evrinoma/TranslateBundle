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

namespace Evrinoma\TranslateBundle\Repository\Api\Translate;

use Evrinoma\TranslateBundle\Mediator\QueryMediatorInterface;
use Evrinoma\TranslateBundle\Repository\Translate\TranslateRepositoryInterface;
use Evrinoma\TranslateBundle\Repository\Translate\TranslateRepositoryTrait;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class TranslateRepository extends TranslateRepositoryWrapper implements TranslateRepositoryInterface, RepositoryWrapperInterface
{
    use TranslateRepositoryTrait;

    /**
     * @param ManagerRegistryInterface $registry
     * @param string                   $entityClass
     * @param QueryMediatorInterface   $mediator
     */
    public function __construct(ManagerRegistryInterface $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry);
        $this->mediator = $mediator;
        $this->entityClass = $entityClass;
    }
}
