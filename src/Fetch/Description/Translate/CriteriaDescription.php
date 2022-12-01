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

namespace Evrinoma\TranslateBundle\Fetch\Description\Translate;

use Evrinoma\FetchBundle\Description\Api\AbstractApiDescription;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Fetch\Handler\BaseGetHandler;
use Symfony\Component\HttpFoundation\Request;

class CriteriaDescription extends AbstractApiDescription
{
    public const NAME = 'api_translate_criteria';
    protected string $method = Request::METHOD_GET;

    protected function getOptions($entity): array
    {
        /* @var TranslateApiDtoInterface $entity */
        $params = [];
        if ($entity->hasCodeSrc()) {
            $params['code_src'] = $entity->getCodeSrc();
        }

        if ($entity->hasCodeDst()) {
            $params['code_dst'] = $entity->getCodeDst();
        }

        if ($entity->hasTextSrc()) {
            $params['text_src'] = $entity->getTextSrc();
        }

        return $params;
    }

    public function load($entity): array
    {
        $params = $this->getOptions($entity);

        $params['text_dst'] = strrev($entity->getTextSrc());

        $params['id'] = 1;

        return [$params];
    }

    /**
     * @return string
     */
    public function tag(): string
    {
        return BaseGetHandler::class;
    }

    public function name(): string
    {
        return static::NAME;
    }
}
