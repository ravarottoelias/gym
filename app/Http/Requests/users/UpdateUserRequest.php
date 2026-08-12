<?php

namespace App\Http\Requests\users;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:mst_users,email,'.$this->id,
            'photo' => 'image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'sometimes|string|min:6|confirmed'
        ];
    }
}
