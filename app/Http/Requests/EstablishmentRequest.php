<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EstablishmentRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rule_id = Rule::unique('establishments', 'id')->whereNull('deleted_at');

        if ($request->method() === 'PUT') {
            $rule_id = Rule::unique('establishments', 'id')->whereNull('deleted_at')->ignore($request->id);
        }

        return [
            'id' => ['required', 'integer', $rule_id],
            'authority_id' => 'required|integer',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'address_line_3' => 'nullable|string|max:255',
            'postcode' => 'required|string|max:255',
            'rating_value' => 'required|integer',
        ];
    }
}
