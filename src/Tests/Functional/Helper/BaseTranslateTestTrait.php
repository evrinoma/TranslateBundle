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

namespace Evrinoma\TranslateBundle\Tests\Functional\Helper;

use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BaseTranslateTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createTranslate(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkTranslate($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkTranslate($entity): void
    {
        Assert::assertArrayHasKey(TranslateApiDtoInterface::ID, $entity);
    }
}
