<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $user_login
 * @property string $user_pass
 * @property string $user_nicename
 * @property string $user_email
 * @property string $user_sex
 * @property string $user_phone
 * @property string $user_qq
 * @property string $user_registered
 * @property string $user_lastlogin
 * @property string $user_sina_open_id
 * @property string $user_qq_open_id
 * @property string $user_weixin_open_id
 * @property string $reg_from
 * @property integer $jinbi
 * @property integer $huiyuan
 * @property string $photo
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jinbi, huiyuan', 'numerical', 'integerOnly'=>true),
			array('user_login', 'length', 'max'=>60),
			array('user_pass', 'length', 'max'=>64),
			array('user_nicename', 'length', 'max'=>50),
			array('user_email, user_sex, user_phone, user_qq, reg_from', 'length', 'max'=>100),
			array('user_sina_open_id, user_qq_open_id, user_weixin_open_id, photo', 'length', 'max'=>255),
			array('user_registered, user_lastlogin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_login, user_pass, user_nicename, user_email, user_sex, user_phone, user_qq, user_registered, user_lastlogin, user_sina_open_id, user_qq_open_id, user_weixin_open_id, reg_from, jinbi, huiyuan, photo', 'safe', 'on'=>'search'),
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
			'user_login' => 'User Login',
			'user_pass' => 'User Pass',
			'user_nicename' => 'User Nicename',
			'user_email' => 'User Email',
			'user_sex' => 'User Sex',
			'user_phone' => 'User Phone',
			'user_qq' => 'User Qq',
			'user_registered' => 'User Registered',
			'user_lastlogin' => 'User Lastlogin',
			'user_sina_open_id' => 'User Sina Open',
			'user_qq_open_id' => 'User Qq Open',
			'user_weixin_open_id' => 'User Weixin Open',
			'reg_from' => 'Reg From',
			'jinbi' => 'Jinbi',
			'huiyuan' => 'Huiyuan',
			'photo' => 'Photo',
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
		$criteria->compare('user_login',$this->user_login,true);
		$criteria->compare('user_pass',$this->user_pass,true);
		$criteria->compare('user_nicename',$this->user_nicename,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_sex',$this->user_sex,true);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('user_qq',$this->user_qq,true);
		$criteria->compare('user_registered',$this->user_registered,true);
		$criteria->compare('user_lastlogin',$this->user_lastlogin,true);
		$criteria->compare('user_sina_open_id',$this->user_sina_open_id,true);
		$criteria->compare('user_qq_open_id',$this->user_qq_open_id,true);
		$criteria->compare('user_weixin_open_id',$this->user_weixin_open_id,true);
		$criteria->compare('reg_from',$this->reg_from,true);
		$criteria->compare('jinbi',$this->jinbi);
		$criteria->compare('huiyuan',$this->huiyuan);
		$criteria->compare('photo',$this->photo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
