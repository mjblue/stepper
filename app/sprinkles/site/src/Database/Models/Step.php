<?php

namespace UserFrosting\Sprinkle\Site\Database\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use UserFrosting\Sprinkle\Core\Database\Models\Model;

class Step extends Model
{
    /**
     * @var string The name of the table for the current model.
     */
    protected $table = 'step_entry';

    protected $fillable = [
        'steps',
        'date',
        'user_id'
    ];

    /**
     * @var bool Enable timestamps for this class.
     */
    public $timestamps = true;

    public function setStepsEntry($userid, $steps, $date)
    {
       
        $this->steps = $steps;
        $this->date = $date;
        $this->user_id = $userid;
    }
}
