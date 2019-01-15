<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMateri extends FormRequest
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
        $var = str_replace('/', '-', $this->request->get('date'));
        $date = date('Y-m-d',strtotime($var) );

        return [
            'agenda_no' => [
                'required',
                Rule::unique('materis')->where(function ($query) use ($date){
                    $query->where('date',$date);
                })
            ],
            'no_dokumen' => 'required',
            'judul' => 'required',
            'presenter' => 'required',
        ];
    }
}
