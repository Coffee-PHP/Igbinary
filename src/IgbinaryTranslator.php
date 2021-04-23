<?php

/**
 * IgbinaryTranslator.php
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
 * @since 2020-08-07
 */

declare(strict_types=1);

namespace CoffeePhp\Igbinary;

use CoffeePhp\Igbinary\Contract\IgbinaryTranslatorInterface;
use CoffeePhp\Igbinary\Exception\IgbinarySerializeException;
use CoffeePhp\Igbinary\Exception\IgbinaryUnserializeException;
use Throwable;

use function igbinary_serialize;
use function igbinary_unserialize;

/**
 * Class IgbinaryTranslator
 * @package coffeephp\igbinary
 * @since 2020-08-07
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class IgbinaryTranslator implements IgbinaryTranslatorInterface
{

    /**
     * @inheritDoc
     */
    public function serializeArray(array $array): string
    {
        try {
            return (string)igbinary_serialize($array);
        } catch (Throwable $e) {
            throw new IgbinarySerializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function unserializeArray(string $string): array
    {
        try {
            return (array)igbinary_unserialize($string);
        } catch (Throwable $e) {
            throw new IgbinaryUnserializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function serializeObject(object $object): string
    {
        try {
            return (string)igbinary_serialize($object);
        } catch (Throwable $e) {
            throw new IgbinarySerializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function unserializeObject(string $string): object
    {
        try {
            return (object)igbinary_unserialize($string);
        } catch (Throwable $e) {
            throw new IgbinaryUnserializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}
