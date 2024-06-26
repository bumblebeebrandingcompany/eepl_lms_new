<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->checkPermission('client_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required'
            ],
            'email' => [
                'unique:clients,email,' . request()->route('client')->id,
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'contact_number_1' => [
                'string',
                'nullable',
            ],
            'contact_number_2' => [
                'string',
                'nullable',
            ],
        ];
    }
}
