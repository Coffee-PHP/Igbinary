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


use CoffeePhp\Binary\Contract\BinaryTranslatorInterface;
use CoffeePhp\Binary\Integration\BinaryComponentRegistrar;
use CoffeePhp\Di\Container;
use CoffeePhp\Edi\Contract\EdiArrayTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiExtendedArrayTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiObjectTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiTranslatorInterface;
use CoffeePhp\Igbinary\Contract\IgbinaryTranslatorInterface;
use CoffeePhp\Igbinary\IgbinaryTranslator;
use CoffeePhp\Igbinary\Integration\IgbinaryComponentRegistrar;
use CoffeePhp\Serialize\Contract\SerializerInterface;
use CoffeePhp\Unserialize\Contract\UnserializerInterface;
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
    public function testRegisterWithoutDependencies(): void
    {
        $di = new Container();
        $registrar = new IgbinaryComponentRegistrar();
        $registrar->register($di);

        assertTrue(
            $di->has(SerializerInterface::class)
        );
        assertTrue(
            $di->has(UnserializerInterface::class)
        );
        assertTrue(
            $di->has(EdiArrayTranslatorInterface::class)
        );
        assertTrue(
            $di->has(EdiExtendedArrayTranslatorInterface::class)
        );
        assertTrue(
            $di->has(EdiObjectTranslatorInterface::class)
        );
        assertTrue(
            $di->has(EdiTranslatorInterface::class)
        );
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
        assertSame(
            $di->get(IgbinaryTranslatorInterface::class),
            $di->get(EdiTranslatorInterface::class)
        );
        assertSame(
            $di->get(IgbinaryTranslatorInterface::class),
            $di->get(EdiObjectTranslatorInterface::class)
        );
        assertSame(
            $di->get(IgbinaryTranslatorInterface::class),
            $di->get(EdiExtendedArrayTranslatorInterface::class)
        );
        assertSame(
            $di->get(IgbinaryTranslatorInterface::class),
            $di->get(EdiArrayTranslatorInterface::class)
        );
        assertSame(
            $di->get(IgbinaryTranslatorInterface::class),
            $di->get(SerializerInterface::class)
        );
        assertSame(
            $di->get(IgbinaryTranslatorInterface::class),
            $di->get(UnserializerInterface::class)
        );
    }

    /**
     * @see BinaryComponentRegistrar::register()
     * @see IgbinaryComponentRegistrar::register()
     */
    public function testRegisterWithDependencies(): void
    {
        $di = new Container();
        $binaryRegistrar = new BinaryComponentRegistrar();
        $registrar = new IgbinaryComponentRegistrar();
        $binaryRegistrar->register($di);
        $registrar->register($di);

        assertTrue(
            $di->has(SerializerInterface::class)
        );
        assertTrue(
            $di->has(UnserializerInterface::class)
        );
        assertTrue(
            $di->has(EdiArrayTranslatorInterface::class)
        );
        assertTrue(
            $di->has(EdiExtendedArrayTranslatorInterface::class)
        );
        assertTrue(
            $di->has(EdiObjectTranslatorInterface::class)
        );
        assertTrue(
            $di->has(EdiTranslatorInterface::class)
        );
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
        assertSame(
            $di->get(BinaryTranslatorInterface::class),
            $di->get(EdiTranslatorInterface::class)
        );
        assertSame(
            $di->get(BinaryTranslatorInterface::class),
            $di->get(EdiObjectTranslatorInterface::class)
        );
        assertSame(
            $di->get(BinaryTranslatorInterface::class),
            $di->get(EdiExtendedArrayTranslatorInterface::class)
        );
        assertSame(
            $di->get(BinaryTranslatorInterface::class),
            $di->get(EdiArrayTranslatorInterface::class)
        );
        assertSame(
            $di->get(BinaryTranslatorInterface::class),
            $di->get(SerializerInterface::class)
        );
        assertSame(
            $di->get(BinaryTranslatorInterface::class),
            $di->get(UnserializerInterface::class)
        );
    }
}
