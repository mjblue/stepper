<?php
namespace UserFrosting\Sprinkle\Site\Database\Migrations\v101;

use UserFrosting\System\Bakery\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

class StepsTable extends Migration
{
    public $dependencies = [
    ];

    public function up()
    {
        if (!$this->schema->hasTable('step_entry')) {
            $this->schema->create('step_entry', function (Blueprint $table) {
                $table->increments('id');
                $table->mediumInteger('steps');
                $table->integer('user_id');
                $table->date('date');
                $table->timestamps();

                $table->engine = 'InnoDB';
                $table->collation = 'utf8_unicode_ci';
                $table->charset = 'utf8';
            });
        }
    }

    public function down()
    {
        $this->schema->drop('step_entry');
    }
}