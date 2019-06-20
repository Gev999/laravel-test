<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckCompanyData extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this);
        return [
            'name' => 'required',
            'email' => 'email|nullable|unique:companies,email,'.$this->id,
            'logo' => 'image|nullable|dimensions:min_width=100,min_height=100',
        ];
    }
}
