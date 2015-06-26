<?php
namespace cent\yii2advanced\components;

use Yii;
use yii\db\ActiveRecord;

use cent\yii2advanced\components\ActiveQueryContainer;

/**
 * BaseActiveRecord is ActiveRecord class for models
 *
 * @package yii2-advanced
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
**/
class BaseActiveRecord  extends ActiveRecord
{
    /**
     * @return ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        // change ActiveQuery to ActiveQueryContainer
        // for applying behaviors
        $activeQuery = Yii::createObject(
            ActiveQueryContainer::className(),
            [get_called_class()]
        );
        return $activeQuery;
    }

    /**
     * Find by
     *
     * @return ActiveQueryInterface
     * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
     **/
    public static function findBy($condition)
    {
        return static::findByCondition($condition);
    }
}
