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
        return [
            'tanggal' => 'required|unique:materis,date,null,id',
            'no_dokumen' => 'required',
            'agenda' => 'required|unique:materis,agenda_no,null,id',
            'judul' => 'required',
            'presenter' => 'required',
        ];
    }
}
