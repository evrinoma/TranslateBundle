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

namespace Evrinoma\TranslateBundle\Tests\Functional\Controller;

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Functional\Orm\AbstractFunctionalTest;
use Evrinoma\TranslateBundle\Fixtures\FixtureInterface;
use Psr\Container\ContainerInterface;

/**
 * @group functional
 */
final class ApiControllerTest extends AbstractFunctionalTest
{
    protected string $actionServiceName = 'evrinoma.translate.test.functional.action.translate';

    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }

    public static function getFixtures(): array
    {
        return [FixtureInterface::TRANSLATE_FIXTURES];
    }
}
