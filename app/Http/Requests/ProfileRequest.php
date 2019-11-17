<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'firstname' => [
                'required', 'min:3', 'max:255'
            ],
            'mi' => [
                'nullable', 'string', 'max:255'
            ],
            'surname' => [
                'required', 'string', 'max:255'
            ],
            'college' => ['string', 'nullable', 'max:255'],
            'department' => ['string', 'nullable', 'max:255'],
            'rank' => ['string', 'nullable', 'max:255'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
        ];
    }
}
