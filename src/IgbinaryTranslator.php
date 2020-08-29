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

declare (strict_types=1);

namespace CoffeePhp\Igbinary;


use CoffeePhp\Igbinary\Contract\IgbinaryTranslatorInterface;
use CoffeePhp\Igbinary\Exception\IgbinarySerializeException;
use CoffeePhp\Igbinary\Exception\IgbinaryUnserializeException;
use Throwable;

use function get_class;
use function igbinary_serialize;
use function igbinary_unserialize;
use function is_array;
use function is_object;
use function is_string;

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
            $serialized = igbinary_serialize($array);
            if (!is_string($serialized)) {
                throw new IgbinarySerializeException(
                    'Data returned from array is not a binary string.'
                );
            }
            return $serialized;
        } catch (IgbinarySerializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new IgbinarySerializeException(
                "Failed to serialize data: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function unserializeArray(string $string): array
    {
        try {
            $unserialized = igbinary_unserialize($string);
            if (!is_array($unserialized)) {
                throw new IgbinaryUnserializeException(
                    "Data returned from igbinary string is not an array: $string"
                );
            }
            return $unserialized;
        } catch (IgbinaryUnserializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new IgbinaryUnserializeException(
                "Failed to unserialize data: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function serializeObject(object $class): string
    {
        try {
            $serialized = igbinary_serialize($class);
            if (!is_string($serialized)) {
                $class = get_class($class);
                throw new IgbinarySerializeException(
                    "Data returned from class is not a binary string: $class"
                );
            }
            return $serialized;
        } catch (IgbinarySerializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            $className = get_class($class);
            throw new IgbinarySerializeException(
                "Failed to serialize class: $className ; Error: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function unserializeObject(string $string): object
    {
        try {
            $unserialized = igbinary_unserialize($string);
            if (!is_object($unserialized)) {
                throw new IgbinaryUnserializeException(
                    "Data returned from binary string failed to unserialize into an object: $string"
                );
            }
            return $unserialized;
        } catch (IgbinaryUnserializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new IgbinaryUnserializeException(
                "Failed to unserialize string: $string ; Error: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }
}
