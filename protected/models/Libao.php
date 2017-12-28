<?php

/**
 * This is the model class for table "libao".
 *
 * The followings are the available columns in table 'libao':
 * @property string $id
 * @property integer $gameid
 * @property string $title
 * @property string $description
 * @property string $createon
 */
class Libao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'libao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required'),
			array('gameid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('createon', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gameid, title, description, createon', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'description' => 'Description',
			'createon' => 'Createon',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createon',$this->createon,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Libao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function used(){
	    $total = LibaoDetail::model()->countByAttributes(array('libaoid'=>$this->id));
	    $residue = LibaoDetail::model()->countByAttributes(array('userid'=>'0', 'libaoid'=>$this->id));// Sql('userid != NULL');
	    
	    if($residue == 0){
	        return '0';
	    }else{
	        return sprintf('%.0f', $residue * 1.00 / $total * 1.00  * 100.00 ); 
	    }
	}
	
	public function gameImg(){
	    $game = Games::model()->findByPk($this->gameid);
	    if($game){
	        return $game->icon;
	    }else{
	        return '/static/d2ebc310da1ef12645b4370623992b15.png';
	    }
	}
	
	public function samelibao(){
	    $criteria=new CDbCriteria;
	    $criteria->condition = " id != ".$this->id." and  gameid = " . $this->gameid;
	    $sames = $this->findAll($criteria);
	    return $sames;
	}
}
