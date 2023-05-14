<?php

namespace Modules\Video\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Video\Contracts\Requests\CreateVideo as CreateVideoContract;
use Modules\Video\Models\VideoStateProxy;

class CreateVideo extends FormRequest implements CreateVideoContract
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'state' => ['required', Rule::in(VideoStateProxy::values())],
            'images' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
    }
}