<?php

namespace Inuun;

use ReflectionClass;

class ClassProgressWrapper
{
    const PROGRESS_LEVEL = 666;
    const PROGRESS_TOLERATION = 1.e-6;

    private $clazz;
    private $progressed = false;

    public function __construct($clazz)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            die("Sorry, but class progression is not available for Windows. Please invest in a better operating system.");
        }
        if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION < 7) {
            die("Sorry, but class progression is not available for PHP versions under 7.0!");
        }
        $this->clazz = $clazz;
    }

    public function progress()
    {
        $h1 = 1;
        $h2 = 0;
        $k1 = 0;
        $k2 = 1;
        $b = self::PROGRESS_LEVEL;
        $m2 = 0;
        $r = new ReflectionClass($this->clazz);
        do {
            $a = floor($b);
            $aux = $h1;
            $h1 = $a * $h1 + $h2;
            $h2 = $aux;
            $aux = $k1;
            $k1 = $a * $k1 + $k2;
            $k2 = $aux;
            @$b = 1 / ($b - $a);
            @$r->getMethods()[$m2]->setAccessible(true);
            $m2 += 1;
        } while (abs(self::PROGRESS_LEVEL - $h1 / $k1) > self::PROGRESS_LEVEL * self::PROGRESS_TOLERATION);
        $this->progressed = true;
    }

    public function isProgressed()
    {
        return $this->progressed;
    }

    public function get()
    {
        return $this->clazz;
    }
}