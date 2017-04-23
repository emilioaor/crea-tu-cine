<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $requestErrors = [];

    /**
     * @param Request $request
     * @param array $params
     * @return bool
     */
    public function requestValidation(Request $request, array $params) {

        foreach ($params as $key => $param) {

            if (isset($param['required']) && $param['required']) {
                //Validar que no este vacio
                if (!isset($request->$key) || $request->$key == '' || $request->$key == null) {
                    $this->requestErrors[] = $param['label'] . ' es un campo requerido';
                }
            }

            if (isset($param['unique']) && isset($param['unique']['class']) && isset($param['unique']['field']) && $request->$key != '' && $request->$key != null) {
                //Validar si ya existe este valor en base de datos
                $unique = $param['unique']['class']::where($param['unique']['field'], $request->$key)->get();
                if (count($unique)) {
                    $this->requestErrors[] = $param['label'] . ' ya esta en uso';
                }
            }

            if (isset($param['min']) && $request->$key != '' && $request->$key != null) {
                //Validar minimo de caracteres
                if (strlen($request->$key) < $param['min']) {
                    $this->requestErrors[] = $param['label'] . ' debe tener al menos ' . $param['min'] . ' caracteres';
                }
            }

            if (isset($param['max']) && $request->$key != '' && $request->$key != null) {
                //Validar maximo de caracteres
                if (strlen($request->$key) > $param['max']) {
                    $this->requestErrors[] = $param['label'] . ' no puede contener mas de ' . $param['max'] . ' caracteres';
                }
            }

            if (isset($param['custom']) && $request->$key != '' && $request->$key != null) {
                foreach ($param['custom'] as $custom) {
                    //Validaciones de formato particular para este campo
                    if (!preg_match($custom, $request->$key)) {
                        $this->requestErrors[] = $param['label'] . ' no contiene el formato correcto';
                    }
                }
            }
        }

        return (count($this->requestErrors) === 0);
    }

    /**
     * @return array
     */
    public function getRequestErrors() {
        return $this->requestErrors;
    }

    /**
     * @param Request $request
     */
    public function createSessionFromRequest(Request $request) {

        foreach ($request->all() as $key => $value) {
            if ($key != 'password' && $key != '_token') {
                Session::flash($key, is_array($value) ? implode(';', $value) : $value);
            }
        }
    }
}
