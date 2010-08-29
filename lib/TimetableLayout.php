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


class TimetableLayout {

    private $lessonMinTime = 0;
    private $lessonMaxTime = 1440;
    private $isFMPHlike = false;
    private $lessons = null;

    /**
     *
     * @param array $lessons Zhydratovany result set pre hodiny, utriedeny podla dna a zaciatku hodiny!
     */
    public function __construct(array $lessons) {
        $this->lessons = $lessons;
        $this->calcStats();
    }

    public function groupByDays() {
        $byDays = array();
        for ($day = 0; $day < 5; $day++) {
            $byDays[] = array();
        }
        foreach($this->lessons as $lesson) {
            $byDays[$lesson['day']][] = $lesson;
        }
        return $byDays;
    }

    private function calcStats() {
        $this->lessonMinTime = 24*60;
        $this->lessonMaxTime = 0;
        $this->isFMPHLike = true; // kazda hodina nespravnej dlzky a casu to moze pokazit
        foreach($this->lessons as $lesson) {
            $this->lessonMinTime = min($this->lessonMinTime, $lesson['start']);
            $this->lessonMaxTime = max($this->lessonMaxTime, $lesson['end']);
            if (($lesson['start'] % 50) != 40 || (($lesson['end']-$lesson['start']) % 45 != 0)) {
                // toto nie je FMFI hodina
                $this->isFMPHLike = false;
            }
        }
    }

    /**
    *
    * Spocitaj tabulkovy layout pre dane hodiny
    *
    * @return array Pole poli poli hodin
    *
    * Jednotlive urovne pola znamenaju:
    *   * Den
    *   * Stlpec v dni
    *   * Zoznam hodin v stlpci
    */
    public function tableLayout() {
        $layout = array();
        for ($day = 0; $day < 5; $day++) {
            $layout[] = array(array());
        }
        // Najprv rozdelim hodiny podla dni a spocitam niektore statistiky
        $byDays = $this->groupByDays();

        // Dalej rozhodim hodiny do stlpcov v dnoch
        for ($day = 0; $day < 5; $day++) {
            foreach($byDays[$day] as $lesson) {
                $added = false;
                foreach($layout[$day] as &$column) {
                    if ($this->isFree($column, $lesson)) {
                        $column[] = $lesson;
                        $added = true;
                        break;
                    }
                }
                if (!$added) {
                    $layout[$day][] = array($lesson);
                }
            }
        }
        
        return $layout;
    }   

    public function isFMPHLike() {
        return $this->isFMPHLike;
    }
    
    public function getLessonMinTime() {
        return $this->lessonMinTime;
    }
    
    public function getLessonMaxTime() {
        return $this->lessonMaxTime;
    }

    public function getLessons() {
        return $this->lessons;
    }
    
    private function isFree($column, $lesson) {
        // iba posledna vec, musi byt utriedene podla casu!
        if (count($column) == 0) return True;
        $last = $column[count($column)-1];
        return ($last['end'] <= $lesson['start']);
    }

}
