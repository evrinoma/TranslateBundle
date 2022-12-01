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

namespace Evrinoma\TranslateBundle\Tests\Functional\Action;

use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\TranslateBundle\Dto\TranslateApiDto;
use Evrinoma\TranslateBundle\Dto\TranslateApiDtoInterface;
use Evrinoma\TranslateBundle\Tests\Functional\Helper\BaseTranslateTestTrait;
use Evrinoma\TranslateBundle\Tests\Functional\ValueObject\Translate\Id;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BaseTranslate extends AbstractServiceTest implements BaseTranslateTestInterface
{
    use BaseTranslateTestTrait;

    public const API_GET = 'evrinoma/api/translate';
    public const API_CRITERIA = 'evrinoma/api/translate/criteria';
    public const API_DELETE = 'evrinoma/api/translate/delete';
    public const API_PUT = 'evrinoma/api/translate/save';
    public const API_POST = 'evrinoma/api/translate/create';

    protected static function getDtoClass(): string
    {
        return TranslateApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            TranslateApiDtoInterface::ID => Id::default(),
        ];
    }

    public function actionPost(): void
    {
        $this->createTranslate();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::ACTIVE => Active::wrong()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::ID => Id::value(), TranslateApiDtoInterface::ACTIVE => Active::block(), TranslateApiDtoInterface::DESCRIPTION => Description::wrong()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::ACTIVE => Active::value(), TranslateApiDtoInterface::ID => Id::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::ACTIVE => Active::delete()]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::ACTIVE => Active::delete(), TranslateApiDtoInterface::DESCRIPTION => Description::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(2, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::ID => 49, TranslateApiDtoInterface::ACTIVE => Active::block(), TranslateApiDtoInterface::DESCRIPTION => Description::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::ACTIVE, $find[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::ACTIVE]);

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::DELETED, $delete[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::ACTIVE]);
    }

    public function actionPut(): void
    {
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::empty());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault([TranslateApiDtoInterface::ID => Id::wrong()]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $query = static::getDefault([TranslateApiDtoInterface::ID => Id::empty()]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createTranslate();
        $this->testResponseStatusCreated();

        $this->createTranslate();
        $this->testResponseStatusConflict();
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();
    }
}
