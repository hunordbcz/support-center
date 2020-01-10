<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => [
                'required', 'exists:categories,id',
            ],
            'type' => [
                'required', 'in:issue,feedback,bug',
            ],
            'priority' => [
                'required', 'in:normal,medium,high,urgent,critical',
            ],
            'subject' => [
                'required', 'max:30',
            ],
            'message' => [
                'required', 'min:10', 'max:600',
            ]
        ];
    }
}
