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

namespace Evrinoma\TranslateBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\CodeDstTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\CodeSrcTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\TextDstTrait;
use Evrinoma\TranslateBundle\DtoCommon\ValueObject\Mutable\TextSrcTrait;
use Symfony\Component\HttpFoundation\Request;

class TranslateApiDto extends AbstractDto implements TranslateApiDtoInterface
{
    use IdTrait;
    use CodeDstTrait;
    use CodeSrcTrait;
    use TextDstTrait;
    use TextSrcTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(TranslateApiDtoInterface::ID);
            $codeSrc = $request->get(TranslateApiDtoInterface::CODE_SRC);
            $codeDst = $request->get(TranslateApiDtoInterface::CODE_DST);
            $textSrc = $request->get(TranslateApiDtoInterface::TEXT_SRC);
            $textDst = $request->get(TranslateApiDtoInterface::TEXT_DST);

            if ($id) {
                $this->setId($id);
            }

            if ($codeSrc) {
                $this->setCodeSrc($codeSrc);
            }

            if ($codeDst) {
                $this->setCodeDst($codeDst);
            }

            if ($textSrc) {
                $this->setTextSrc($textSrc);
            }

            if ($textDst) {
                $this->setTextDst($textDst);
            }
        }

        return $this;
    }
}
