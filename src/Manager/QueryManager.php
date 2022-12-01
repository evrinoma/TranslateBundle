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
use Evrinoma\TranslateBundle\Repository\Translate\TranslateQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private TranslateQueryRepositoryInterface $repository;

    public function __construct(TranslateQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws TranslateNotFoundException
     */
    public function criteria(TranslateApiDtoInterface $dto): array
    {
        try {
            $translate = $this->repository->findByCriteria($dto);
        } catch (TranslateNotFoundException $e) {
            throw $e;
        }

        return $translate;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateProxyException
     */
    public function proxy(TranslateApiDtoInterface $dto): TranslateInterface
    {
        try {
            if ($dto->hasId()) {
                $translate = $this->repository->proxy($dto->idToString());
            } else {
                throw new TranslateProxyException('Id value is not set while trying get proxy object');
            }
        } catch (TranslateProxyException $e) {
            throw $e;
        }

        return $translate;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateNotFoundException
     */
    public function get(TranslateApiDtoInterface $dto): TranslateInterface
    {
        try {
            $translate = $this->repository->find($dto->idToString());
        } catch (TranslateNotFoundException $e) {
            throw $e;
        }

        return $translate;
    }
}
