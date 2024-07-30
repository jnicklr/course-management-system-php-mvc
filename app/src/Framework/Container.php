<?php

namespace Framework;

use Closure;

class Container
{
    private array $services;

    public function setService(string $class_name, Closure $class_value): void
    {
        $this->services[$class_name] = $class_value;
    }

    public function getService(string $class_name): object|null
    {
        return array_key_exists($class_name, $this->services) ? $this->services[$class_name]() : null;
    }

    public function getDependencies(string $class): array
    {
        $dependencies = [];
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if ($constructor) {
            foreach ($constructor->getParameters() as $parameter) {
                $parameterType = $parameter->getType();
                if ($parameterType !== null) {
                    $dependencyClass = $parameterType->getName();
                    $dependencies[$parameter->getName()] = new $dependencyClass(...$this->getDependencies($dependencyClass));
                } else {
                    throw new \Exception("Parameter type not found for {$parameter->getName()} in class $class");
                }
            }
        }

        return $dependencies;
    }

    public function build(string $class): object
    {
        return new $class($this->getDependencies($class));
    }
}