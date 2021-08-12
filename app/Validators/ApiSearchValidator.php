<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ApiSearchValidator 
{
    public function inputValidate($input, $method)
    {
        return Validator::make($input, 
            $this->rules($input, $method),
            $this->messages()
        );
    }

    private function rules($input, $method)
    {
        $rules = [
            'search' => 'required|between:1,256',
            'order' => 'in:desc,asc',
            'page' => 'integer',
            'per_page' => 'integer|max:100',
            'repository_id' => 'integer'
        ];
        if (!isset($input['user']) && !isset($input['repo']) && !isset($input['org']) && $method != 'topics'){
            $rules['user_repo_org'] = 'required';
        }

        if (isset($input['page'])){
            $rules['per_page'] = 'required|integer|max:100';
        } else if (isset($input['per_page'])){
            $rules['page'] = 'required|integer';
        }

        return $rules;
    }

    private function messages()
    {
        return [
            'search.required' => 'Parametr :attribute nie może być pusty',
            'search.between' => 'Parametr :attribute nie może zawierać więcej niż 256 znaków',
            'order.in' => 'Parametr :attribute może przyjmować wyłącznie wartości: "asc" lub "desc"',
            'page.required' => 'Parametr :attribute jest wymagany',
            'page.integer' => 'Parametr :attribute musi być liczbą',
            'per_page.required' => 'Parametr :attribute jest wymagany',
            'per_page.integer' => 'Parametr :attribute musi być liczbą',
            'per_page.max' => 'Parametr :attribute może mieć maksymalną wartość 100',
            'repository_id.integer' => 'Parametr :attribute musi być liczbą',
            'user_repo_org.required' => 'Jeden z parametrów: :attribute, jest wymagany'
        ];
    }
}