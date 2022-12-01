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

namespace Evrinoma\TranslateBundle\Serializer;

interface GroupInterface
{
    public const API_POST_TRANSLATE = 'API_POST_TRANSLATE';
    public const API_PUT_TRANSLATE = 'API_PUT_TRANSLATE';
    public const API_GET_TRANSLATE = 'API_GET_TRANSLATE';
    public const API_CRITERIA_TRANSLATE = self::API_GET_TRANSLATE;
    public const APP_GET_BASIC_TRANSLATE = 'APP_GET_BASIC_TRANSLATE';
}
