<?php

/**
 * IgbinaryComponentRegistrar.php
 *
 * Copyright 2020 Danny Damsky
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package coffeephp\igbinary
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2020-08-29
 */

declare(strict_types=1);

namespace CoffeePhp\Igbinary\Integration;

use CoffeePhp\ComponentRegistry\Contract\ComponentRegistrarInterface;
use CoffeePhp\Di\Contract\ContainerInterface;
use CoffeePhp\Edi\Contract\EdiArrayTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiExtendedArrayTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiObjectTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiTranslatorInterface;
use CoffeePhp\Igbinary\Contract\IgbinaryTranslatorInterface;
use CoffeePhp\Igbinary\IgbinaryTranslator;
use CoffeePhp\Serialize\Contract\SerializerInterface;
use CoffeePhp\Unserialize\Contract\UnserializerInterface;

/**
 * Class IgbinaryComponentRegistrar
 * @package coffeephp\igbinary
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2020-08-29
 */
final class IgbinaryComponentRegistrar implements ComponentRegistrarInterface
{

    /**
     * @inheritDoc
     */
    public function register(ContainerInterface $di): void
    {
        if (
            !$di->has(SerializerInterface::class) ||
            !$di->has(UnserializerInterface::class) ||
            !$di->has(EdiArrayTranslatorInterface::class) ||
            !$di->has(EdiExtendedArrayTranslatorInterface::class) ||
            !$di->has(EdiObjectTranslatorInterface::class) ||
            !$di->has(EdiTranslatorInterface::class)
        ) {
            $di->bind(SerializerInterface::class, IgbinaryTranslatorInterface::class);
            $di->bind(UnserializerInterface::class, IgbinaryTranslatorInterface::class);

            $di->bind(EdiArrayTranslatorInterface::class, IgbinaryTranslatorInterface::class);
            $di->bind(EdiExtendedArrayTranslatorInterface::class, IgbinaryTranslatorInterface::class);
            $di->bind(EdiObjectTranslatorInterface::class, IgbinaryTranslatorInterface::class);
            $di->bind(EdiTranslatorInterface::class, IgbinaryTranslatorInterface::class);
        }

        $di->bind(IgbinaryTranslatorInterface::class, IgbinaryTranslator::class);
        $di->bind(IgbinaryTranslator::class, IgbinaryTranslator::class);
    }
}
