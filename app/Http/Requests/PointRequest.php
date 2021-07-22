<?php


namespace App\Http\Requests;


class PointRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'comment' => 'required|string',
            'image' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
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
            'comment.required' => 'Comment should be sting!',
            'image.string' => 'Image required!',
            'latitude.string' => 'latitude required!',
            'longitude.string' => 'longitude required!'
        ];
    }
}
