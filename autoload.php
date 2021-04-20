<?php

function load($className)
{
    include_once 'classes/$className';
}

spl_autoload_register('load');
