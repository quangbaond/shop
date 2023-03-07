<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|regex:/\w*$/|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'address' => 'required|string|max:255',
            'number_phone' => 'required|string|max:255',
            'status' => 'required|boolean',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    // change message
    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được quá 255 ký tự',
            'username.required' => 'Tên đăng nhập không để trong',
            'username.string' => 'Ten đăng nhập phải là chuỗi',
            'username.max' => 'Tên đăng nhập không được quá 255 ký tự',
            'username.regex' => 'Tên đăng nhập không được chứa ký tự đặc biệt',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.string' => 'Email phải là chuỗi',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.string' => 'Mật khẩu phải là chuỗi',
            'password.min' => 'Mật khẩu không được nhỏ hơn 6 ký tự',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'address.string' => 'Địa chỉ phải là chuỗi',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
            'number_phone.required' => 'Số điện thoại không được để trống',
            'number_phone.string' => 'Số điện thoại phải là chuỗi',
            'number_phone.max' => 'Số điện thoại không được quá 255 ký tự',
            'status.required' => 'Trạng thái không được để trống',
            'status.boolean' => 'Trạng thái phải là kiểu boolean',
            'avatar.required' => 'Ảnh đại diện không được để trống',
            'avatar.image' => 'Ảnh đại diện phải là kiểu ảnh',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg,png,jpg,gif,svg',
            'avatar.max' => 'Ảnh đại diện không được quá 2048 ký tự',
        ];
    }
}
