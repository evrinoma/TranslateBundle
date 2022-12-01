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
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeCreatedException;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeRemovedException;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeSavedException;
use Evrinoma\TranslateBundle\Exception\TranslateInvalidException;
use Evrinoma\TranslateBundle\Exception\TranslateNotFoundException;
use Evrinoma\TranslateBundle\Factory\TranslateFactoryInterface;
use Evrinoma\TranslateBundle\Mediator\CommandMediatorInterface;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;
use Evrinoma\TranslateBundle\Repository\Translate\TranslateRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private TranslateRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private TranslateFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface           $validator
     * @param TranslateRepositoryInterface $repository
     * @param TranslateFactoryInterface    $factory
     * @param CommandMediatorInterface     $mediator
     */
    public function __construct(ValidatorInterface $validator, TranslateRepositoryInterface $repository, TranslateFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateInvalidException
     * @throws TranslateCannotBeCreatedException
     * @throws TranslateCannotBeSavedException
     */
    public function post(TranslateApiDtoInterface $dto): TranslateInterface
    {
        $translate = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $translate);

        $errors = $this->validator->validate($translate);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new TranslateInvalidException($errorsString);
        }

        $this->repository->save($translate);

        return $translate;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @return TranslateInterface
     *
     * @throws TranslateInvalidException
     * @throws TranslateNotFoundException
     * @throws TranslateCannotBeSavedException
     */
    public function put(TranslateApiDtoInterface $dto): TranslateInterface
    {
        try {
            $translate = $this->repository->find($dto->idToString());
        } catch (TranslateNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $translate);

        $errors = $this->validator->validate($translate);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new TranslateInvalidException($errorsString);
        }

        $this->repository->save($translate);

        return $translate;
    }

    /**
     * @param TranslateApiDtoInterface $dto
     *
     * @throws TranslateCannotBeRemovedException
     * @throws TranslateNotFoundException
     */
    public function delete(TranslateApiDtoInterface $dto): void
    {
        try {
            $translate = $this->repository->find($dto->idToString());
        } catch (TranslateNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $translate);
        try {
            $this->repository->remove($translate);
        } catch (TranslateCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
