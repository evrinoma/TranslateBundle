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

namespace Evrinoma\TranslateBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\TranslateBundle\Validator\TranslateValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class TranslatePass extends AbstractConstraint implements CompilerPassInterface
{
    public const TRANSLATE_CONSTRAINT = 'evrinoma.translate.constraint.property';

    protected static string $alias = self::TRANSLATE_CONSTRAINT;
    protected static string $class = TranslateValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
