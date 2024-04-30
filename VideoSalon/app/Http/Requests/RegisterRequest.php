<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'surname' => 'required|min:2|max:255',
            'e-mail' => 'required|min:2|max:255',
            'phone' => 'required|string|regex:/^\+7-\d{3}-\d{3}-\d{2}-\d{2}$/i',
            'password' => 'required|min:2|max:255'
        ];
    }

    public function massages():array
    {
        return [
            'name.required' => 'поле имя не заполнено',
            'surnamename.required' => 'поле фамилия не заполнено',
            'e-mail.required' => 'поле e-mail не заполнено',
            'password.required' => 'поле пароль не заполнено',
            'phone.required' => 'поле номер телефона не заполнено',
        ];
    }
}
