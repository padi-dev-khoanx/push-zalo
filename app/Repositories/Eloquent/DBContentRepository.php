<?php

namespace App\Repositories\Eloquent;

use App\Models\Content;
use App\Repositories\ContentRepository;

class DBContentRepository extends DBRepository implements ContentRepository
{

    public function __construct(Content $model)
    {
        parent::__construct($model);
    }

    public function queryHistory()
    {
        return $this->model->orderBy('response_sent_time', 'desc');
    }
}