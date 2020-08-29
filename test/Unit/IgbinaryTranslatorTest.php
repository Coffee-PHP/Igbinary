<?php

/**
 * IgbinaryTranslatorTest.php
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
 * @since 2020-08-01
 */

declare (strict_types=1);

namespace CoffeePhp\Igbinary\Test\Unit;


use CoffeePhp\Igbinary\IgbinaryTranslator;
use PHPUnit\Framework\TestCase;
use stdClass;

use function igbinary_serialize;

/**
 * Class IgbinaryTranslatorTest
 * @package coffeephp\igbinary
 * @since 2020-08-01
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @see IgbinaryTranslator
 */
final class IgbinaryTranslatorTest extends TestCase
{
    /**
     * @see IgbinaryTranslator::serializeArray()
     * @see IgbinaryTranslator::unserializeArray()
     */
    public function testSerializeAndUnserializeArray(): void
    {
        $array = [
            'a' => 'b',
            'c' => 2,
            'd' => true,
            'e' => null,
            null => 2,
            2 => null
        ];

        $instance = new IgbinaryTranslator();

        $serialized = $instance->serializeArray($array);

        self::assertSame(
            igbinary_serialize($array),
            $serialized
        );

        $unserialized = $instance->unserializeArray($serialized);

        self::assertSame(
            $array,
            $unserialized
        );
    }

    /**
     * @see IgbinaryTranslator::serializeObject()
     * @see IgbinaryTranslator::unserializeObject()
     */
    public function testSerializeAndUnserializeClass(): void
    {
        $class = new stdClass();
        $class->a = 'b';
        $class->c = 2;
        $class->d = true;
        $class->e = null;
        $class->null = 2;

        $instance = new IgbinaryTranslator();

        $serialized = $instance->serializeObject($class);

        self::assertSame(
            igbinary_serialize($class),
            $serialized
        );

        $unserialized = $instance->unserializeObject($serialized);

        self::assertEquals(
            $class,
            $unserialized
        );
    }
}
