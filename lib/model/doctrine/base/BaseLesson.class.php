<?php

/**
 * BaseLesson
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $day
 * @property integer $start
 * @property integer $end
 * @property integer $lesson_type_id
 * @property integer $room_id
 * @property integer $subject_id
 * @property LessonType $LessonType
 * @property Room $Room
 * @property Subject $Subject
 * @property Doctrine_Collection $StudentGroupLessons
 * @property Doctrine_Collection $TeacherLessons
 * 
 * @method integer             getDay()                 Returns the current record's "day" value
 * @method integer             getStart()               Returns the current record's "start" value
 * @method integer             getEnd()                 Returns the current record's "end" value
 * @method integer             getLessonTypeId()        Returns the current record's "lesson_type_id" value
 * @method integer             getRoomId()              Returns the current record's "room_id" value
 * @method integer             getSubjectId()           Returns the current record's "subject_id" value
 * @method LessonType          getLessonType()          Returns the current record's "LessonType" value
 * @method Room                getRoom()                Returns the current record's "Room" value
 * @method Subject             getSubject()             Returns the current record's "Subject" value
 * @method Doctrine_Collection getStudentGroupLessons() Returns the current record's "StudentGroupLessons" collection
 * @method Doctrine_Collection getTeacherLessons()      Returns the current record's "TeacherLessons" collection
 * @method Lesson              setDay()                 Sets the current record's "day" value
 * @method Lesson              setStart()               Sets the current record's "start" value
 * @method Lesson              setEnd()                 Sets the current record's "end" value
 * @method Lesson              setLessonTypeId()        Sets the current record's "lesson_type_id" value
 * @method Lesson              setRoomId()              Sets the current record's "room_id" value
 * @method Lesson              setSubjectId()           Sets the current record's "subject_id" value
 * @method Lesson              setLessonType()          Sets the current record's "LessonType" value
 * @method Lesson              setRoom()                Sets the current record's "Room" value
 * @method Lesson              setSubject()             Sets the current record's "Subject" value
 * @method Lesson              setStudentGroupLessons() Sets the current record's "StudentGroupLessons" collection
 * @method Lesson              setTeacherLessons()      Sets the current record's "TeacherLessons" collection
 * 
 * @package    candle
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseLesson extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lesson');
        $this->hasColumn('day', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('start', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('end', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('lesson_type_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('room_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('subject_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('LessonType', array(
             'local' => 'lesson_type_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Room', array(
             'local' => 'room_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Subject', array(
             'local' => 'subject_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('StudentGroupLessons', array(
             'local' => 'id',
             'foreign' => 'lesson_id'));

        $this->hasMany('TeacherLessons', array(
             'local' => 'id',
             'foreign' => 'lesson_id'));
    }
}