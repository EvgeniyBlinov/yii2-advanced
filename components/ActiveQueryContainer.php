<?php
namespace cent\yii2advanced\components;

use yii\db\ActiveQuery;

/**
 * ActiveQueryContainer
 *
 * @package yii2-advanced
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
**/
class ActiveQueryContainer extends ActiveQuery
{
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
