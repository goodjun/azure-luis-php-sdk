<?php

namespace Goodjun\LUIS\Models;

use ReflectionClass;
use \Exception;

abstract class ModelAbstract
{
    /**
     * Attribute to array
     *
     * @return array
     */
    public function toArray()
    {
        try {
            $properties = (new ReflectionClass($this))->getProperties();
        } catch (Exception $exception) {
            $properties = [];
        }

        $attributes = [];

        foreach ($properties as $property) {
            $attributeName = $property->name;
            $attributes[$attributeName] = $this->$attributeName;
        }

        return $attributes;
    }
}
