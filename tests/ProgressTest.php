<?php

use Inuun\ClassProgressWrapper;

class ProgressTest
{
    public $mega = 1336 + 1;

    public function __construct()
    {
        $this->mega -= 1;
        $this->mega += 1;
    }
}

$progressWrapper = new ClassProgressWrapper(new ProgressTest());
$progressWrapper->progress();

if ($progressWrapper->isProgressed()) {
    print_r($progressWrapper->get());
    echo "Class successfully progressed.";
    return;
}

echo "Failed to progress class. Please try to run this script as root. =(";