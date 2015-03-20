<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * FotoPerfil is the model behind the upload form.
 */
class FotoPerfil extends Model
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
    public $usuario;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'gif, jpg, png',],
            [['usuario'], 'required'],
        ];
    }
}
?>