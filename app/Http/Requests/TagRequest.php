<?php


namespace App\Http\Requests;


class TagRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title should be sting!'
        ];
    }
}
