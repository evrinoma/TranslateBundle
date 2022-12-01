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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): TranslateInterface
    {
        $this->fill($dto, $entity);

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): TranslateInterface
    {
        $this->fill($dto, $entity);

        return $entity;
    }

    private function fill(DtoInterface $dto, $entity): void
    {
        /* @var $dto TranslateApiDtoInterface */
        $entity
            ->setCodeDst($dto->getCodeDst())
            ->setCodeSrc($dto->getCodeSrc())
            ->setTextDst($dto->getTextDst())
            ->setTextSrc($dto->getTextSrc())
        ;
    }
}
