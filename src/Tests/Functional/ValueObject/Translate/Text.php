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

namespace Evrinoma\TranslateBundle\Tests\Functional\ValueObject\Translate;

use Evrinoma\TestUtilsBundle\ValueObject\AbstractValueObject;

class Text extends AbstractValueObject
{
    protected static string $default = 'Привет мир';
    protected static string $value = 'Hello world';

    public static function wrong(): string
    {
        return static::$wrong ?? '';
    }

    public static function ru(): string
    {
        return static::$default;
    }

    public static function en(): string
    {
        return static::$value;
    }
}
