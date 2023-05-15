<?php

namespace Modules\Video\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Konekt\AppShell\Http\Requests\HasFor;
use Modules\Video\Contracts\Requests\UploadVideo as UploadVideoContract;

class UploadVideo extends FormRequest implements UploadVideoContract {

    use HasFor;


    /**
     * @inheritDoc
     */
    public function rules() {
        return [
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ];
    }

    /**
     * @inheritDoc
     */
    public function authorize() {
        return true;
    }

}
