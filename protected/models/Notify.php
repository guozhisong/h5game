<?php
class Notify extends CActiveRecord
{
	public function tableName()
	{
		return 'send_notify';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
