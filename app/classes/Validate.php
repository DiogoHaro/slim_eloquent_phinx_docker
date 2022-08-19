<?php
namespace app\classes;
use Illuminate\Database\Eloquent\Model;

class Validate
{
    private $errors = [];

    public function required(array $fields)
    {
        foreach($fields as $field){
            if(empty($_POST[$field])){
                $this->setErrors($field, "{$field} is required");
            }
        }

        return $this;
    }

    public function alreadyUse(Model $model, $field, $value)
    {
        if(!empty($value)) {
            $data = $model::where($field, '=', $value)->first();
            if($data){
                $this->setErrors($field, "{$field} já esta em uso");
            } 
        }

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($field, $message)
    {
        $this->errors[$field] = $message;
    }
}