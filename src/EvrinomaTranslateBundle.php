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

namespace Evrinoma\TranslateBundle;

use Evrinoma\TranslateBundle\DependencyInjection\Compiler\Constraint\Property\TranslatePass;
use Evrinoma\TranslateBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\TranslateBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\TranslateBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\TranslateBundle\DependencyInjection\EvrinomaTranslateExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaTranslateBundle extends Bundle
{
    public const BUNDLE = 'translate';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new TranslatePass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaTranslateExtension();
        }

        return $this->extension;
    }
}
