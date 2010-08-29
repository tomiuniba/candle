<?php

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


class Candle {
    static public function formatTime($timeVal) {
        $h = intval($timeVal/60);
        $m = ''.$timeVal%60;
        if (strlen($m)<2) {
            $m = '0'.$m;
        }
        return $h.':'.$m;
    }
    
    static public function formatShortDay($dayNum) {
        $days = array('Po', 'Ut', 'St', 'Št', 'Pi');
        return $days[$dayNum];
    }
    
    static public function formatLongDay($dayNum) {
        $days = array('Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok');
        return $days[$dayNum];
    }
    
    static public function formatRowspan($rowspan) {
        if ($rowspan <= 1) {
            return '';
        }
        else {
            return ' rowspan="'.$rowspan.'" ';
        }
    }
    
    static public function formatClass($classes) {
        if (!$classes || count($classes) == 0) return '';
        return ' class="'.implode(' ', $classes).'" ';
    }

    static public function formatTD($classes=null, $rowspan=1) {
        return '<td'.Candle::formatClass($classes).Candle::formatRowspan($rowspan).'>';
    }
    
    static public function floorTo($number, $precision) {
        return $number - ($number % $precision);
    }
    
    static public function ceilTo($number, $precision) {
        if (($number % $precision) == 0) return $number;
        return Candle::floorTo($number, $precision) + $precision;
    }
    
    static public function dayFromCode($code) {
        $days = array('pon'=>0, 'uto'=>1, 'str'=>2, 'stv'=>3, 'pia'=>4);
        return $days[$code];
    }
    
    static public function nbsp($text) {
        return str_replace(' ', '&nbsp;', $text);
    }

    static public function formatShortName($teacher) {
        $old_encoding = mb_internal_encoding();
        
        mb_internal_encoding(mb_detect_encoding($teacher['given_name']));
        $shortName = ($teacher['given_name']?mb_substr($teacher['given_name'], 0, 1).'. ':'').$teacher['family_name'];
        mb_internal_encoding($old_encoding);
        return $shortName;
    }

    static public function formatLongName($teacher) {
        return ($teacher['given_name']?$teacher['given_name'].' ':'').$teacher['family_name'];
    }

    static public function setTimetableExportResponse(sfWebRequest $request, sfActions $actions) {
        $format = $request->getRequestFormat();

        switch ($format)
        {
            case 'csv':
                $actions->setLayout(false);
                $actions->getResponse()->setContentType('text/csv;header=present'); // vid RFC 4180
                break;
            case 'ics':
                $actions->setLayout(false);
                $actions->getResponse()->setContentType('text/calendar'); // vid RFC 2445
                break;
        }
    }

    static public function getLessonTypeHTMLClass($lessonType) {
        return 'lesson-type-'.strtoupper($lessonType['code']);
    }

    static public function addFormat(array $url, $format) {
        return array_merge($url, array('sf_format'=>$format));
    }

    static public function subjectShortCodeFromLongCode($longCode) {
        // PriF/1-UBI-004-1/7064/00 -> 1-UBI-004
        $firstSlash = strpos($longCode, '/');
        if ($firstSlash === false) return false;
        $secondSlash = strpos($longCode, '/', $firstSlash+1);
        if ($secondSlash === false) return false;
        return substr($longCode, $firstSlash+1, $secondSlash-$firstSlash-1);
    }

    static public function upper($string) {
        $old_encoding = mb_internal_encoding();

        mb_internal_encoding(mb_detect_encoding($string));
        $result = mb_strtoupper($string);
        mb_internal_encoding($old_encoding);
        return $result;
    }
}
