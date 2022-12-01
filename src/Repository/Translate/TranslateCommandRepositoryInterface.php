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

namespace Evrinoma\TranslateBundle\Repository\Translate;

use Evrinoma\TranslateBundle\Exception\TranslateCannotBeRemovedException;
use Evrinoma\TranslateBundle\Exception\TranslateCannotBeSavedException;
use Evrinoma\TranslateBundle\Model\Translate\TranslateInterface;

interface TranslateCommandRepositoryInterface
{
    /**
     * @param TranslateInterface $translate
     *
     * @return bool
     *
     * @throws TranslateCannotBeSavedException
     */
    public function save(TranslateInterface $translate): bool;

    /**
     * @param TranslateInterface $translate
     *
     * @return bool
     *
     * @throws TranslateCannotBeRemovedException
     */
    public function remove(TranslateInterface $translate): bool;
}
