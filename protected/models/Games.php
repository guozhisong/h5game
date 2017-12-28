<?php

/**
 * This is the model class for table "games".
 *
 * The followings are the available columns in table 'games':
 * @property string $id
 * @property string $desc
 * @property string $game_picture
 * @property string $game_egret_id
 * @property string $icon
 * @property string $name
 * @property string $short_desc
 * @property string $type
 * @property integer $from
 * @property string $enter
 */
class Games extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'games';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, desc, icon, game_picture', 'required'),
			array('from, status', 'numerical', 'integerOnly'=>true),
			array('game_egret_id, discount', 'length', 'max'=>50),
			array('icon, name, short_desc, type', 'length', 'max'=>255),
			array('enter, notify_url', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, desc, game_picture, discount, game_egret_id, icon, name, notify_url, short_desc, type, from, enter, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'cpadmin'=>array(self::BELONGS_TO, 'CpAdmin', 'cp_mid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'desc' => '游戏描述',
			'game_picture' => '截图',
			'game_egret_id' => 'Game Egret',
			'icon' => '游戏icon',
			'name' => '游戏名',
			'discount' => '游戏折扣',
			'short_desc' => '游戏短描述',
			'type' => 'Type',
			'notify_url' => '支付回调地址',
			'from' => 'From',
			'status' => '审核状态',
			'enter' => '游戏入口地址',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('game_picture',$this->game_picture,true);
		$criteria->compare('game_egret_id',$this->game_egret_id,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name',$this->discount,true);
		$criteria->compare('short_desc',$this->short_desc,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('notify_url',$this->notify_url,true);
		$criteria->compare('enter',$this->enter,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Games the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
