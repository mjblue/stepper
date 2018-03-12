<?php

namespace UserFrosting\Sprinkle\Site\Database\Migrations\v101;

use UserFrosting\System\Bakery\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use UserFrosting\Sprinkle\Site\Database\Models\Step;

class DefaultSteps extends Migration
{
    /**
     * {@inheritDoc}
     */
    public $dependencies = [
        '\UserFrosting\Sprinkle\Site\Database\Migrations\v101\stepsTable'
    ];

    /**
     * {@inheritDoc}
     */
    public function up()
    {
        foreach ($this->steps() as $step) {
            $step = new Step($step);
            $step->save();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        foreach ($this->steps() as $step) {
            $step = step::where($step)->first();
            $step->delete();
        }
    }

    protected function steps()
    {
        return [
            [
                'user_id' => '1',
                'steps' => '4000',
                'date' => '2018-02-12'
            ],
            [
                'user_id' => '1',
                'steps' => '4500',
                'date' => '2018-02-14'
            ]
        ];
    }
}