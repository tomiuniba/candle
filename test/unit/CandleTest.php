<?php require_once dirname(__FILE__).'/../bootstrap/unit.php';

/**

    Copyright 2010 Martin Sucha

    This file is part of Candle.

    Candle is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Candle is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Candle.  If not, see <http://www.gnu.org/licenses/>.

*/

/**
 *
 */


$t = new lime_test(31);

$t->is(Candle::formatTime(0),'0:00');
$t->is(Candle::formatTime(5),'0:05');
$t->is(Candle::formatTime(60),'1:00');
$t->is(Candle::formatTime(65),'1:05');
$t->is(Candle::formatTime(990),'16:30');
$t->is(Candle::formatTime(1090),'18:10');

$t->is(Candle::formatShortDay(0),'Po');
$t->is(Candle::formatShortDay(1),'Ut');
$t->is(Candle::formatShortDay(2),'St');
$t->is(Candle::formatShortDay(3),'Št');
$t->is(Candle::formatShortDay(4),'Pi');

$t->is(Candle::formatRowspan(0), '');
$t->is(Candle::formatRowspan(1), '');
$t->is(Candle::formatRowspan(2), ' rowspan="2" ');

$t->is(Candle::floorTo(30, 60), 0);
$t->is(Candle::floorTo(0, 60), 0);
$t->is(Candle::floorTo(60, 60), 60);
$t->is(Candle::floorTo(69,60), 60);
$t->is(Candle::floorTo(30, 15), 30);

$t->is(Candle::ceilTo(30, 60), 60);
$t->is(Candle::ceilTo(0, 60), 0);
$t->is(Candle::ceilTo(40, 30), 60);
$t->is(Candle::ceilTo(60, 60), 60);

$t->is(Candle::formatShortName(array('given_name'=>'Ľubomír', 'family_name'=>'Vráskavý')), 'Ľ. Vráskavý');
$t->is(Candle::formatShortName(array('family_name'=>'Vráskavý')), 'Vráskavý');
$t->is(Candle::formatShortName(array('given_name'=>'Igor', 'family_name'=>'Bud')), 'I. Bud');
$t->is(Candle::formatShortName(array('given_name'=>'Šaňo', 'family_name'=>'Alexander')), 'Š. Alexander');

$t->is(Candle::subjectShortCodeFromLongCode('PriF/1-UBI-004-1/7064/00'), '1-UBI-004-1');
$t->is(Candle::subjectShortCodeFromLongCode('PriF/1-UBI-007-1/7054/00'), '1-UBI-007-1');
$t->is(Candle::subjectShortCodeFromLongCode('FMFI.KI/1-INF-465/00'), '1-INF-465');
$t->is(Candle::subjectShortCodeFromLongCode('FMFI.KI/1-INF-500-2/3051/00'), '1-INF-500-2');