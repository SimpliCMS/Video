<?php

namespace Modules\Video\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Video\Contracts\Requests\UpdateVideo as UpdateVideoContract;
use Modules\Video\Models\VideoStateProxy;

class UpdateVideo extends FormRequest implements UpdateVideoContract {

    public function rules() {
        return [
            'name' => 'nullable|min:2|max:255',
            'state' => ['required', Rule::in(VideoStateProxy::values())],
            'url' => 'nullable',
        ];
    }

    public function authorize() {
        return true;
    }

    protected function prepareForValidation() {
        
    }

}
