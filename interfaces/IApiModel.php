<?php
namespace cent\yii2advanced\interfaces;
/**
 * IApiModel
 *
 * @package yii2-advanced
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
 **/
interface  IApiModel
{
    /**
     * Get all relations
     *
     * @return array
     **/
    public static function getAllRelations();

    /**
     * Get api relations
     *
     * @return array
     **/
    public static function getApiRelations();

}
