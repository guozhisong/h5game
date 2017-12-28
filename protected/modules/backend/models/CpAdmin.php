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
class CpAdmin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cp_admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('com_name, name, password', 'required'),
			array('com_name, name', 'length', 'min'=>4, 'max'=>255),
			array('password', 'length', 'min'=>6, 'max'=>64),
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
			'com_name, ' => '企业名称',
			'name' => '管理员',
			'password' => '密码',
			'status' => '状态',
			'group_type' => '类型',
			'created_at' => '创建时间',
			'updated_at' => '修改时间',
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
//	public function search()
//	{
//		// @todo Please modify the following code to remove attributes that should not be searched.
//
//		$criteria=new CDbCriteria;
//
//		$criteria->compare('id',$this->id,true);
//		$criteria->compare('name',$this->name,true);
//		$criteria->compare('password',$this->password,true);
//		$criteria->compare('status',$this->status,true);
//		$criteria->compare('group_type',$this->group_type,true);
//		$criteria->compare('created_at',$this->created_at,true);
//		$criteria->compare('updated_at',$this->updated_at,true);
//
//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));
//	}

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
