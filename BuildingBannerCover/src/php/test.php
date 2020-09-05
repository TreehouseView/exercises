<?php

$sut = require 'BuildingBannerCover.php';

var_dump($sut([3,1,4]) . ' = ' . 10);
var_dump($sut([5,3,2,4]) . ' = ' . 17);
var_dump($sut([5,3,5,2,1]) . ' = ' . 19);
var_dump($sut([7,7,3,7,7]) . ' = ' . 35);
var_dump($sut([1,1,7,6,6,6]) . ' = ' . 30);
var_dump($sut([100,100,100,100]) . ' = ' . 400);
var_dump($sut([5,10,5,10]) . ' = ' . 35);
