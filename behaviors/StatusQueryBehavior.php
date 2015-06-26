<?php
namespace cent\yii2advanced\behaviors;

use Yii;
use yii\base\Behavior;

use cent\yii2advanced\interfaces\IStatusModel;

/**
 * StatusQueryBehavior
 *
 * @package yii2-advanced
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
**/
class StatusQueryBehavior extends Behavior
{
    /**
     * Get enabled records
     *
     * @return ActiveQuery
     * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
     **/
    public function enabled()
    {
        $modelClass = $this->owner->modelClass;
        $this->owner->andWhere(['status' => IStatusModel::STATUS_ENABLED]);
        return $this->owner;
    }
}
