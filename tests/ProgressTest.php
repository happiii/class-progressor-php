<?php

use Inuun\ClassProgressWrapper;

class ProgressTest
{
    public $mega = 1336 + 1;
}

$progressWrapper = new ClassProgressWrapper(new ProgressTest());
$progressWrapper->progress();
$progressTest = $progressWrapper->get();