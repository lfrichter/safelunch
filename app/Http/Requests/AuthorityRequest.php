<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorityRequest extends FormRequest
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
        $rule_id = Rule::unique('authorities', 'id')->whereNull('deleted_at');

        if ($request->method() === 'PUT') {
            $rule_id = Rule::unique('authorities', 'id')->whereNull('deleted_at')->ignore($request->id);
        }

        return [
            'id' => ['required', 'integer', $rule_id],
            'local_authority_id_code' => 'nullable|string',
            'name' => 'required|string|max:255',
            'region_name' => 'required|string|max:255',
        ];
    }
}
