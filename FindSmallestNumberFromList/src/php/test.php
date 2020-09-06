<?php

$sut = require 'FindSmallestNumberFromList.php';

var_dump($sut([1,2,3,4,5,6,7,8,9,10,12]) . ' = 11');
var_dump($sut([1,2,3,5,6,7,8,9,10,12]) . ' = 4');
var_dump($sut([-1,-2,-3,-5,-6,-7,-8,-9,-10,-12]) . ' = 1');
var_dump($sut([0,0,0,0,0,0]) . ' = 1');
var_dump($sut([1,'2','3',4]) . ' = 5');
