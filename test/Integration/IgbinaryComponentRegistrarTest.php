<?php

/**
 * IgbinaryComponentRegistrarTest.php
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

declare (strict_types=1);

namespace CoffeePhp\Igbinary\Test\Integration;


use CoffeePhp\ComponentRegistry\ComponentRegistry;
use CoffeePhp\Di\Container;
use CoffeePhp\Igbinary\Contract\IgbinaryTranslatorInterface;
use CoffeePhp\Igbinary\IgbinaryTranslator;
use CoffeePhp\Igbinary\Integration\IgbinaryComponentRegistrar;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

/**
 * Class IgbinaryComponentRegistrarTest
 * @package coffeephp\igbinary
 * @since 2020-08-29
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @see IgbinaryComponentRegistrar
 */
final class IgbinaryComponentRegistrarTest extends TestCase
{
    /**
     * @see IgbinaryComponentRegistrar::register()
     */
    public function testRegister(): void
    {
        $di = new Container();
        $registry = new ComponentRegistry($di);
        $registry->register(IgbinaryComponentRegistrar::class);

        assertTrue(
            $di->has(IgbinaryTranslatorInterface::class)
        );
        assertTrue(
            $di->has(IgbinaryTranslator::class)
        );

        assertInstanceOf(
            IgbinaryTranslator::class,
            $di->get(IgbinaryTranslator::class)
        );

        assertSame(
            $di->get(IgbinaryTranslator::class),
            $di->get(IgbinaryTranslatorInterface::class)
        );
    }
}
