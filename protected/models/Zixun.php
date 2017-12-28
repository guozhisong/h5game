<?php

/**
 * This is the model class for table "zixun".
 *
 * The followings are the available columns in table 'zixun':
 * @property string $id
 * @property integer $gameid
 * @property string $type
 * @property string $content
 * @property string $create_on
 * @property string $title
 * @property string $short_title
 * @property string $keywords
 * @property string $description
 */
class Zixun extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zixun';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('gameid', 'numerical', 'integerOnly'=>true),
			array('type, title, short_title, keywords, description', 'length', 'max'=>255),
			array('create_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gameid, type, content, create_on, title, short_title, keywords, description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gameid' => 'Gameid',
			'type' => 'Type',
			'content' => 'Content',
			'create_on' => 'Create On',
			'title' => 'Title',
			'short_title' => 'Short Title',
			'keywords' => 'Keywords',
			'description' => 'Description',
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
		$criteria->compare('gameid',$this->gameid);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_on',$this->create_on,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_title',$this->short_title,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zixun the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
