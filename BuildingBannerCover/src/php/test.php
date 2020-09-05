<?php

$sut = require 'BuildingBannerCover.php';

var_dump($sut([1,2,3,4,5]) . ' = ' . 19);
var_dump($sut([3,1,6]) . ' = ' . 12);
var_dump($sut([4,7,2,9,7,4]) . ' = ' . 48);
var_dump($sut([3,6,10,100,34,2]) . ' = ' . 330);
var_dump($sut([5,3,8,99,101]) . ' = ' . 226);
