<?php

/**
 * BaseLinkedLessons
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $lesson1_id
 * @property integer $lesson2_id
 * @property Lesson $Lesson1
 * @property Lesson $Lesson2
 * 
 * @method integer       getLesson1Id()  Returns the current record's "lesson1_id" value
 * @method integer       getLesson2Id()  Returns the current record's "lesson2_id" value
 * @method Lesson        getLesson1()    Returns the current record's "Lesson1" value
 * @method Lesson        getLesson2()    Returns the current record's "Lesson2" value
 * @method LinkedLessons setLesson1Id()  Sets the current record's "lesson1_id" value
 * @method LinkedLessons setLesson2Id()  Sets the current record's "lesson2_id" value
 * @method LinkedLessons setLesson1()    Sets the current record's "Lesson1" value
 * @method LinkedLessons setLesson2()    Sets the current record's "Lesson2" value
 * 
 * @package    candle
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLinkedLessons extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('linked_lessons');
        $this->hasColumn('lesson1_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('lesson2_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Lesson as Lesson1', array(
             'local' => 'lesson1_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Lesson as Lesson2', array(
             'local' => 'lesson2_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}