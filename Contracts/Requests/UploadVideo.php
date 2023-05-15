<?php

namespace Modules\Video\Contracts\Requests;

use Illuminate\Database\Eloquent\Model;
use Konekt\Concord\Contracts\BaseRequest;

interface UploadVideo extends BaseRequest {

    /**
     * Returns the model media need(s) to be added for
     *
     * @return null|Model
     */
    public function getFor();
}
