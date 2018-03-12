<?php
namespace UserFrosting\Sprinkle\Site\Sprunje;

use UserFrosting\Sprinkle\Core\Facades\Debug;
use UserFrosting\Sprinkle\Core\Sprunje\Sprunje;

use UserFrosting\Sprinkle\Site\Database\Models\Step;

class StepSprunje extends Sprunje
{
    protected $name = 'steps';

    /**
     * Set the initial query used by your Sprunje.
     */
    protected function baseQuery()
    {
        $instance = new Owl();

        // Alternatively, if you have defined a class mapping, you can use the classMapper:
        // $instance = $this->classMapper->createInstance('owl');

        return $instance->newQuery();
    }
}