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

namespace Evrinoma\TranslateBundle\Entity\Translate;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\TranslateBundle\Model\Translate\AbstractTranslate;

/**
 * @ORM\Table(name="e_translate")
 * @ORM\Entity
 */
class BaseTranslate extends AbstractTranslate
{
}
