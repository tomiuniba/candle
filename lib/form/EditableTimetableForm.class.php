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

class EditableTimetableForm extends sfForm {
    public function configure() {
        $this->setWidgets(array(
            'name' => new sfWidgetFormInputText()
        ));
        
        $this->setValidators(array(
            'name' => new sfValidatorString()
        ));
        
        $this->widgetSchema->setLabels(array(
            'name' => 'Názov rozvrhu'
        ));

    }
}
