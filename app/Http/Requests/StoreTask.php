<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
            'name'          => 'required|string|min:3|max:255',
            'description'   => 'string|max:1024',
            'status_id'        => 'required|exists:task_statuses,id',
            'assigned_to_id'    => 'required|exists:users,id',
            "tags"    => "array",
            "tags.*"  => "required|string|min:2",
        ];
    }
}
