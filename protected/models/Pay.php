<?php

/**
 * This is the model class for table "pay".
 *
 * The followings are the available columns in table 'pay':
 * @property string $id
 * @property integer $user_id
 * @property integer $jinbi
 * @property string $amount
 * @property string $out_trade_no
 * @property string $trade_no
 * @property string $date
 * @property integer $status
 * @property string $backurl
 * @property string $extra
 */
class Pay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, jinbi, status', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>10),
			array('out_trade_no, trade_no, backurl, extra', 'length', 'max'=>2550),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, jinbi, amount, org_amount, discount, out_trade_no, trade_no, date, status, backurl, extra', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO, 'Users', 'user_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'jinbi' => 'Jinbi',
			'org_amount' => 'Org_amount',
			'amount' => 'Amount',
			'discount' => 'Discount',
			'out_trade_no' => 'Out Trade No',
			'trade_no' => 'Trade No',
			'date' => 'Date',
			'status' => 'Status',
			'backurl' => 'Backurl',
			'extra' => 'Extra',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('jinbi',$this->jinbi);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('out_trade_no',$this->out_trade_no,true);
		$criteria->compare('trade_no',$this->trade_no,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('backurl',$this->backurl,true);
		$criteria->compare('extra',$this->extra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
