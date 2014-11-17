<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilityHtml
 *
 * @author Administrador
 */
class UtilityHtml {

    public static function getImagetitle($status) {
        if ($status == "S" || strtolower($status) == 'yes') {
            return 'Active';
        } else {
            return 'Inactive';
        }
    }

    public static function getStatusImage($status) {
        if ($status == "S" || strtolower($status) == 'yes') {
             return Yii::app()->request->baseUrl . '/img/checked.png';
        } else {
            return Yii::app()->request->baseUrl . '/img/unchecked.png';
        }
    }
    
    public static function getStatusSpan($status) {
        if ($status == "S" || strtolower($status) == 'yes') {
            return "<span class=\"glyphicon glyphicon-check\"></span>";
        } else {
            return "<span class=\"glyphicon glyphicon-unchecked\"></span>";
        }
    }

}
