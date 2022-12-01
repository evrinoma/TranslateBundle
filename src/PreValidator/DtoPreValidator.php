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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Exception\TranslateInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this->checkCodeDst($dto);
        $this->checkCodeSrc($dto);
        $this->checkTextDst($dto);
        $this->checkTextSrc($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this->checkId($dto);
        $this->checkCodeDst($dto);
        $this->checkCodeSrc($dto);
        $this->checkTextDst($dto);
        $this->checkTextSrc($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkId($dto);
    }

    private function checkId(DtoInterface $dto): void
    {
        /** @var TranslateApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new TranslateInvalidException('The Dto has\'t ID or class invalid');
        }
    }

    private function checkCodeSrc(DtoInterface $dto): void
    {
        /** @var TranslateApiDtoInterface $dto */
        if (!$dto->hasCodeSrc()) {
            throw new TranslateInvalidException('The Dto has\'t code Src or class invalid');
        }
    }

    private function checkCodeDst(DtoInterface $dto): void
    {
        /** @var TranslateApiDtoInterface $dto */
        if (!$dto->hasCodeDst()) {
            throw new TranslateInvalidException('The Dto has\'t code Dst or class invalid');
        }
    }

    private function checkTextSrc(DtoInterface $dto): void
    {
        /** @var TranslateApiDtoInterface $dto */
        if (!$dto->hasTextSrc()) {
            throw new TranslateInvalidException('The Dto has\'t text Src or class invalid');
        }
    }

    private function checkTextDst(DtoInterface $dto): void
    {
        /** @var TranslateApiDtoInterface $dto */
        if (!$dto->hasTextDst()) {
            throw new TranslateInvalidException('The Dto has\'t text Dst or class invalid');
        }
    }
}
