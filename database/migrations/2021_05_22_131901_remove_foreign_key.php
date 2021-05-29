<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // SET foreign key for table prices (prices.product_id = products.id)
         if (Schema::hasColumn('prices', 'product_id') && Schema::hasTable('products')) {
            Schema::table('prices', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // SET foreign key for table prices (prices.product_id = products.id)
         if (Schema::hasColumn('prices', 'product_id') && Schema::hasTable('products')) {
            Schema::table('prices', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }
    }
}
