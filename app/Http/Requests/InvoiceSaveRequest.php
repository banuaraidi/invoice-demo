<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceSaveRequest extends FormRequest
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
            'currency' => 'required|integer',
            'subject' => 'required|string',
            'due_date' => 'required|date_format:d/m/Y',
            'issue_date' => 'required|date_format:d/m/Y',
            'status' => 'required|string',
            'from_customer_id' => 'required|integer',
            'to_customer_id' => 'required|integer',
        ];
    }
}
