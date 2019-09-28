<?php

namespace App\Services;

use App\Enums\ArrayTypes;
use App\Enums\ResponseTypes;

    /**
 * Class will be used to log errors relating to a users actions.
 */
class InternalResponseService
{
    private $error = false;
    private $success = false;
    private $type = '';
    private $arrayType = '';
    protected $data = [];
    protected $errors = [];

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    public function internalStatusDataObject()
    {
        return [
           'error' => $this->error,
           'success' => $this->success,
           'type' => $this->type,
           'data' => $this->data,
           'errors' => $this->errors,
       ];
    }

    /**
     * @param $array
     * @return $this
     */
    private function isSequentialOrAssociative($array)
    {
        $className = 'Illuminate\Support\MessageBag';
        $res = $array instanceof $className;
        if ($res) {
            $messages = $array->messages();
        }else {
            $messages = $array;
        }


        // Checking for sequential keys of array arr
        if (array_keys($messages) === range(0, count($messages) - 1)) {
            $this->arrayType = ArrayTypes::SEQUENTIAL();
        } else {
            $this->arrayType = ArrayTypes::ASSOCIATIVE();
        }

        return $this;
    }

    public function isSequential(){
        return !empty($this->arrayType) && $this->arrayType === ArrayTypes::SEQUENTIAL() ? true : false;
    }

    public function reset()
    {
        $this->error = false;
        $this->success = false;
        $this->data = [];
        $this->errors = [];
    }

    /**
     * @param $data
     */
    private function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param errors single array or nested array under key 'error
     */
    private function setErrors($errors)
    {
        
        // if ($this->isSequentialOrAssociative($errors)->isSequential()) {
        //      $this->errors = ['error' => $errors];
        //      return;
        // }

        $this->errors = $errors;    
        return;   
    }

    public function getDirectusData($all = false) 
    {
        if ($all) {
            return $this->data->data;;
        }
        
        return $this->data->data[0];
    }

    /**
     * @param Enums\ResponseTypes as string $type 
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function data()
    {
        return $this->data;
    }

    public function responseType()
    {
        return $this->type;
    }

    public function error($data = null)
    {
        $this->error = true;
        $this->success = false;
        $this->setErrors($data);

        return $this;
    }

    public function hasErrors()
    {
        return $this->error && !$this->success;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function success($data = null)
    {
        $this->success = true;
        $this->error = false;
        $this->setData($data);

        return $this;
    }

    public function withInternalDataObject()
    {
        return $this->internalStatusDataObject();
    }
}
