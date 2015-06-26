<?php
namespace cent\yii2advanced\behaviors;

use Yii;
use yii\base\Behavior;

/**
 * ApiQueryBehavior
 *
 * @package alvion
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
**/
class ApiQueryBehavior extends Behavior
{
    /**
     * With all relations
     *
     * @return ActiveQuery
     * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
     **/
    public function allRelations()
    {
        $modelClass = $this->owner->modelClass;
        $this->owner->with($modelClass::getAllRelations());
        return $this->owner;
    }
}
