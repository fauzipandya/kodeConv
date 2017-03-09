<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class konvertUp extends Model{
    public $csv_file;
    public function rules(){
        return[
            [['csv_file', 'file','skipOnEmpty'=>false,
              'extensions'=>'csv']]
            ];
    }
    public function upload(){
        if($this->validate()){
            $nameCsv=$this->csv_file->baseName.'.'.$this->csv_file->extension;
            $file=fopen($nameCsv,'r');
            
            
            return true;
         
        } else {
            return false;
        }
    }
}
