<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = "uploadRecords";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
