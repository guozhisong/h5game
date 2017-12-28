<?php
class NotifyLog extends CActiveRecord
{
	public function tableName()
	{
		return 'send_notify_log';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
