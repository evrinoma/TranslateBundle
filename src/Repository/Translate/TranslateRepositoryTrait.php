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
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeRemovedException;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeSavedException;
use Evrinoma\TranslateBundle\Exception\TranslateNotFoundException;
use Evrinoma\TranslateBundle\Exception\TranslateProxyException;
use Evrinoma\TranslateBundle\Mediator\QueryMediatorInterface;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

trait TranslateRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param TranslateInterface $translate
     *
     * @return bool
     *
     * @throws TranslateCannotBeSavedException
     * @throws ORMException
     */
    public function save(TranslateInterface $translate): bool
    {
        try {
            $this->persistWrapped($translate);
        } catch (ORMInvalidArgumentException $e) {
            throw new TranslateCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param TranslateInterface $translate
     *
     * @return bool
     */
    public function remove(TranslateInterface $translate): bool
    {
        try {
            $this->removeWrapped($translate);
        } catch (ORMInvalidArgumentException $e) {
            throw new TranslateCannotBeRemovedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws TranslateNotFoundException
     */
    public function findByCriteria(TranslateApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $translates = $this->mediator->getResult($dto, $builder);

        if (0 === \count($translates)) {
            throw new TranslateNotFoundException('Cannot find translate by findByCriteria');
        }

        return $translates;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws TranslateNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): TranslateInterface
    {
        /** @var TranslateInterface $translate */
        $translate = $this->findWrapped($id);

        if (null === $translate) {
            throw new TranslateNotFoundException("Cannot find translate with id $id");
        }

        return $translate;
    }

    /**
     * @param string $id
     *
     * @return TranslateInterface
     *
     * @throws TranslateProxyException
     * @throws ORMException
     */
    public function proxy(string $id): TranslateInterface
    {
        $translate = $this->referenceWrapped($id);

        if (!$this->containsWrapped($translate)) {
            throw new TranslateProxyException("Proxy doesn't exist with $id");
        }

        return $translate;
    }
}
