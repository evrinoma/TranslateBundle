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

namespace Evrinoma\TranslateBundle\Fetch\Handler;

use Evrinoma\FetchBundle\Handler\AbstractHandler;

class BaseGetHandler extends AbstractHandler
{
    public const NAME = 'dummy';

    public function isValid(): bool
    {
        return \is_array($this->data);
    }

    public function name(): string
    {
        return static::NAME;
    }
}
