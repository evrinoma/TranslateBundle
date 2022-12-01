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

namespace Evrinoma\TranslateBundle\DependencyInjection\Compiler;

use Evrinoma\TranslateBundle\DependencyInjection\EvrinomaTranslateExtension;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ('orm' === $container->getParameter('evrinoma.translate.storage')) {
            $this->setContainer($container);

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $referenceAnnotationReader = new Reference('annotations.reader');

            $this->cleanMetadata($driver, [EvrinomaTranslateExtension::ENTITY]);

            $entityTranslate = $container->getParameter('evrinoma.translate.entity');
            if (str_contains($entityTranslate, EvrinomaTranslateExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Translate', '%s/Entity/Translate');
            }
            $this->addResolveTargetEntity([$entityTranslate => [TranslateInterface::class => []]], false);
        }
    }
}
