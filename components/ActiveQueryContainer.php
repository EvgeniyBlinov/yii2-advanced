<?php
namespace cent\yii2advanced\components;

use yii\db\ActiveQuery;
use cent\yii2advanced\behaviors\ApiQueryBehavior;
use cent\yii2advanced\behaviors\StatusQueryBehavior;

/**
 * ActiveQueryContainer
 *
 * @package yii2-advanced
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
**/
class ActiveQueryContainer extends ActiveQuery
{
    /**
     * Behaviors
     *
     * @return array of behaviors
     * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
     **/
    public function behaviors()
    {
        $behaviors = [];
        if (is_subclass_of($this->modelClass, '\cent\yii2advanced\interfaces\IApiModel')) {
            $behaviors[] = ApiQueryBehavior::className();
        }
        if (is_subclass_of($this->modelClass, '\cent\yii2advanced\interfaces\IStatusModel')) {
            $behaviors[] = StatusQueryBehavior::className();
        }

        return $behaviors;
    }

    /**
     * Scopes
     *
     * @param mixed $scopes
     * @return ActiveQueryContainer
     * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
     **/
    public function scopes($scopes)
    {
        if (is_array($scopes)) {
            foreach ($scopes as $scopeName => $scopeOptions) {
                if (is_numeric($scopeName)) {
                    $scopeName    = $scopeOptions;
                    $scopeOptions = [];
                }
                call_user_func_array([$this, 'applyScope'], [$scopeName, $scopeOptions]);
            }
        } else {
            $this->applyScope($scopes);
        }

        return $this;
    }

    /**
     * Apply scope
     *
     * @param string $scope
     * @param array $params
     * @return void
     * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
     **/
    public function applyScope($scope, array $params = [])
    {
        if ($this->hasMethod($scope)) {
            return call_user_func_array([$this, $scope], $params);
        }

        return $this;
    }
}
