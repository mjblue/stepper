<?php

namespace UserFrosting\Sprinkle\Site\Database\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use UserFrosting\Sprinkle\Core\Database\Models\Model;
use Carbon\Carbon;

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

    public function getMyRecentStepsEntries($currentUserId)
    {


        $carbon = new Carbon();
        $startWeek = Carbon::parse('Sunday')->addWeeks(-1);
       //$steps = User::where('date', '>=', 2)->get();
        //$recentsteps = Step::where('date', '>=', "now() - interval 7 day")->get();
        $recentsteps = Step::where('user_id', $currentUserId->id)
                    ->where('date','<', $carbon )
                    ->where('date','>=', $startWeek )
                    ->get();
       // $steps = User::where('date', '>=', 2)->get();
        
       
        return $recentsteps;
        
    }

    public function getMyRecentStepsTotal($currentUserId)
    {

        $carbon = new Carbon();
        $startWeek = Carbon::parse('Sunday')->addWeeks(-1);
       //$steps = User::where('date', '>=', 2)->get();
        //$recentsteps = Step::where('date', '>=', "now() - interval 7 day")->get();
        $recentstepstotal = Step::select(Capsule::raw("sum(steps)"))
                    //->where('user_id', $currentUserId->id)
                    ->where('date','<', $carbon )
                    ->where('date','>=', $startWeek )
                    ->get();
       // $steps = User::where('date', '>=', 2)->get();
        
       
        return $recentstepstotal;
        
    }

}
