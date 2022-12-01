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
use Evrinoma\TranslateBundle\Tests\Functional\ValueObject\Translate\Code;
use Evrinoma\TranslateBundle\Tests\Functional\ValueObject\Translate\Id;
use Evrinoma\TranslateBundle\Tests\Functional\ValueObject\Translate\Text;
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
            TranslateApiDtoInterface::CODE_SRC => Code::ru(),
            TranslateApiDtoInterface::CODE_DST => Code::en(),
            TranslateApiDtoInterface::TEXT_SRC => Text::ru(),
            TranslateApiDtoInterface::TEXT_DST => Text::en(),
        ];
    }

    public function actionPost(): void
    {
        $this->createTranslate();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::CODE_DST => Code::wrong()]);
        $this->testResponseStatusNotFound();
    }

    public function actionCriteria(): void
    {
        $created = $this->createTranslate();
        $this->testResponseStatusCreated();

        $find = $this->criteria([TranslateApiDtoInterface::DTO_CLASS => static::getDtoClass(), TranslateApiDtoInterface::CODE_DST => Code::ru(), TranslateApiDtoInterface::ID => Id::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $created = $this->createTranslate();
        $this->testResponseStatusCreated();

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $find = $this->get(Id::value());
        $this->testResponseStatusNotFound();
    }

    public function actionPut(): void
    {
        $created = $this->createTranslate();
        $this->testResponseStatusCreated();

        $updated = $this->put(static::getDefault(
            [
                TranslateApiDtoInterface::ID => Id::value(),
                TranslateApiDtoInterface::CODE_DST => Code::ru(),
                TranslateApiDtoInterface::CODE_SRC => Code::en(),
                TranslateApiDtoInterface::TEXT_DST => Text::ru(),
                TranslateApiDtoInterface::TEXT_SRC => Text::en(),
            ]
        ));
        $this->testResponseStatusOK();

        Assert::assertEquals($created[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::ID]);
        Assert::assertNotEquals($created[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::CODE_DST], $updated[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::CODE_DST]);
        Assert::assertNotEquals($created[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::CODE_SRC], $updated[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::CODE_SRC]);
        Assert::assertNotEquals($created[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::TEXT_DST], $updated[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::TEXT_DST]);
        Assert::assertNotEquals($created[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::TEXT_SRC], $updated[PayloadModel::PAYLOAD][0][TranslateApiDtoInterface::TEXT_SRC]);
    }

    public function actionGet(): void
    {
        $created = $this->createTranslate();
        $this->testResponseStatusCreated();
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
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();
    }
}
