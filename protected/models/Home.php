<?php

/**
 * This is the model class for table "home".
 *
 * The followings are the available columns in table 'home':
 * @property string $id
 * @property string $slidershow
 * @property string $t1
 * @property string $t2
 * @property string $t3
 * @property string $t4
 * @property string $t5
 * @property string $t6
 * @property string $t7
 * @property string $t8
 * @property string $t9
 * @property string $t10
 * @property string $t11
 * @property string $t12
 * @property string $t13
 * @property string $t14
 * @property string $t15
 * @property string $t16
 * @property string $t17
 * @property string $t18
 * @property string $t19
 * @property string $t20
 * @property string $t21
 * @property string $t22
 * @property string $t23
 * @property string $t24
 * @property string $t25
 * @property string $t26
 * @property string $t27
 * @property string $t28
 * @property string $t29
 * @property string $t30
 * @property string $t31
 * @property string $t32
 * @property string $t33
 */
class Home extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'home';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slidershow', 'required'),
			array('t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14, t15, t16, t17, t18, t19, t20, t21, t22, t23, t24, t25, t26, t27, t28, t29, t30, t31, t32, t33', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, slidershow, t1, t2, t3, t4, t5, t6, t7, t8, t9, t10, t11, t12, t13, t14, t15, t16, t17, t18, t19, t20, t21, t22, t23, t24, t25, t26, t27, t28, t29, t30, t31, t32, t33', 'safe', 'on'=>'search'),
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
			'slidershow' => 'Slidershow',
			't1' => 'T1',
			't2' => 'T2',
			't3' => 'T3',
			't4' => 'T4',
			't5' => 'T5',
			't6' => 'T6',
			't7' => 'T7',
			't8' => 'T8',
			't9' => 'T9',
			't10' => 'T10',
			't11' => 'T11',
			't12' => 'T12',
			't13' => 'T13',
			't14' => 'T14',
			't15' => 'T15',
			't16' => 'T16',
			't17' => 'T17',
			't18' => 'T18',
			't19' => 'T19',
			't20' => 'T20',
			't21' => 'T21',
			't22' => 'T22',
			't23' => 'T23',
			't24' => 'T24',
			't25' => 'T25',
			't26' => 'T26',
			't27' => 'T27',
			't28' => 'T28',
			't29' => 'T29',
			't30' => 'T30',
			't31' => 'T31',
			't32' => 'T32',
			't33' => 'T33',
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
		$criteria->compare('slidershow',$this->slidershow,true);
		$criteria->compare('t1',$this->t1,true);
		$criteria->compare('t2',$this->t2,true);
		$criteria->compare('t3',$this->t3,true);
		$criteria->compare('t4',$this->t4,true);
		$criteria->compare('t5',$this->t5,true);
		$criteria->compare('t6',$this->t6,true);
		$criteria->compare('t7',$this->t7,true);
		$criteria->compare('t8',$this->t8,true);
		$criteria->compare('t9',$this->t9,true);
		$criteria->compare('t10',$this->t10,true);
		$criteria->compare('t11',$this->t11,true);
		$criteria->compare('t12',$this->t12,true);
		$criteria->compare('t13',$this->t13,true);
		$criteria->compare('t14',$this->t14,true);
		$criteria->compare('t15',$this->t15,true);
		$criteria->compare('t16',$this->t16,true);
		$criteria->compare('t17',$this->t17,true);
		$criteria->compare('t18',$this->t18,true);
		$criteria->compare('t19',$this->t19,true);
		$criteria->compare('t20',$this->t20,true);
		$criteria->compare('t21',$this->t21,true);
		$criteria->compare('t22',$this->t22,true);
		$criteria->compare('t23',$this->t23,true);
		$criteria->compare('t24',$this->t24,true);
		$criteria->compare('t25',$this->t25,true);
		$criteria->compare('t26',$this->t26,true);
		$criteria->compare('t27',$this->t27,true);
		$criteria->compare('t28',$this->t28,true);
		$criteria->compare('t29',$this->t29,true);
		$criteria->compare('t30',$this->t30,true);
		$criteria->compare('t31',$this->t31,true);
		$criteria->compare('t32',$this->t32,true);
		$criteria->compare('t33',$this->t33,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Home the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
