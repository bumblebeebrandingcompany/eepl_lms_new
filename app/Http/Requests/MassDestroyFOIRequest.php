<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFOIRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->checkPermission('eoi_delete');
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lead_events,id',
        ];
    }
}
