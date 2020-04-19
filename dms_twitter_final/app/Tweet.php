<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    /**
     * The table associated with the model and primary key associated with
     * model.
     *
     * @var string
     */
    protected $table = 'Tweet';
    protected $primaryKey = 'tweet_id';
}
