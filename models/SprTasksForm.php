<?php
/**
 * Created by PhpStorm.
 * User: diana
 * Date: 25.09.18
 * Time: 16:34
 */

namespace app\models;
/**
* @property string $ownerlogin логин администратора задачи
 */

class SprTasksForm extends SprTasks
{

    public $ownerlogin = null;


    public function rules()
    {
        return [
            [['ownerlogin', 'name', 'type_id','bdate'], 'required'],
            [['ownerlogin', 'type_id','bdate', 'edate'], 'validateTask'],      // пользовательская валидация полей формы
            [['type_id'], 'integer'],
            [['ownerlogin', 'bdate', 'edate'], 'safe'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @return bool
     */
    public function validateTask(){

        // проверка существования данного логина

        $isLogin = SprUsers::findOne( ['username' => $this->ownerlogin] );
        if( !$isLogin )
        {
            $this->addError('ownerlogin', \Yii::t('tasks', 'This user does not exist'));
        }

        // проверка существования типа задачи

        $isType = SprTaskTypes::findOne( ['id' => $this->type_id] );
        if(!$isType){
            $this->addError('type_id', \Yii::t('tasks', 'This type does not exist'));
        }

        // проверка корректности даты начала задачи (не раньше текущего времени)

        $isBDate = ( strtotime($this->bdate) >= time() );
        if(!$isBDate){
            $this->addError('bdate', \Yii::t('tasks', 'Incorrect date of the begin'));
        }

        // проверка корректности даты окончания задачи (не раньше начала)


        if( isset ($this->edate) ){
            $isEDate = ( strtotime($this->edate) >= strtotime($this->bdate) + 3600 );
            if(!$isEDate){
                $this->addError('edate', \Yii::t('tasks', 'Incorrect date of the end'));
            }
        } else {
            $isEDate = true;
        }




        return ($isLogin && $isType && $isBDate && $isEDate);   // вернет true только если все проверки будут пройдены
    }


//    public function afterFind()
//    {
//        if(!parent::afterFind()){
//            return false;
//        }
//
//        $this->bdate = date("d-m-Y H:m", strtotime( $this->bdate ));
//        $this->edate = date("d-m-Y H:m", strtotime( $this->edate ));
//    }


}