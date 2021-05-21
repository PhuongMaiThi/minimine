<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SET foreign key for table admins (admins.role_id = roles.id)
        if (Schema::hasColumn('admins', 'role_id') && Schema::hasTable('roles')) {
            Schema::table('admins', function (Blueprint $table) {
                    $table->foreign('role_id')->references('id')->on('roles');
                });
            }

            // SET foreign key for table products (products.category_id = categories.id)
            if (Schema::hasColumn('products', 'category_id') && Schema::hasTable('categories')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->foreign('category_id')->references('id')->on('categories');
                });
            }

            // SET foreign key for table product_details (product_details.product_id = products.id)
            if (Schema::hasColumn('product_details', 'product_id') && Schema::hasTable('products')) {
            Schema::table('product_details', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }

        // SET foreign key for table product_images (product_images.product_id = products.id)
        if (Schema::hasColumn('product_images', 'product_id') && Schema::hasTable('products')) {
            Schema::table('product_images', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }

        // SET foreign key for table prices (prices.product_id = products.id)
        if (Schema::hasColumn('prices', 'product_id') && Schema::hasTable('products')) {
            Schema::table('prices', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }

        // SET foreign key for table promotions (promotions.product_id = products.id)
        if (Schema::hasColumn('promotions', 'product_id') && Schema::hasTable('products')) {
            Schema::table('promotions', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }

        // SET foreign key for table orders (orders.user_id = users.id)
        if (Schema::hasColumn('orders', 'user_id') && Schema::hasTable('users')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
            });
        }

        // SET foreign key for table order_details (order_details.user_id = orders.id)
        if (Schema::hasColumn('order_details', 'order_id') && Schema::hasTable('orders')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->foreign('order_id')->references('id')->on('orders');
            });
        }

        // SET foreign key for table order_details (order_details.product_id = products.id)
        if (Schema::hasColumn('order_details', 'product_id') && Schema::hasTable('products')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }

        // SET foreign key for table order_details (order_details.price_id = prices.id)
        if (Schema::hasColumn('order_details', 'price_id') && Schema::hasTable('prices')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->foreign('price_id')->references('id')->on('prices');
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
        // DROP foreign key for table admins (admins.role_id = roles.id)
        if (Schema::hasColumn('admins', 'role_id') && Schema::hasTable('roles')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropForeign(['role_id']);
            });
        }

        // DROP foreign key for table products (products.category_id = categories.id)
        if (Schema::hasColumn('products', 'category_id') && Schema::hasTable('categories')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }

         // DROP foreign key for table product_details (product_details.product_id = products.id)
         if (Schema::hasColumn('product_details', 'product_id') && Schema::hasTable('products')) {
            Schema::table('product_details', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });
        }

        // DROP foreign key for table product_images (product_images.product_id = products.id)
        if (Schema::hasColumn('product_images', 'product_id') && Schema::hasTable('products')) {
            Schema::table('product_images', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });
        }

        // DROP foreign key for table prices (prices.product_id = products.id)
        if (Schema::hasColumn('prices', 'product_id') && Schema::hasTable('products')) {
            Schema::table('prices', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });
        }

        // DROP foreign key for table promotions (promotions.product_id = products.id)
        if (Schema::hasColumn('promotions', 'product_id') && Schema::hasTable('products')) {
            Schema::table('promotions', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });
        }
        
        // DROP foreign key for table orders (orders.user_id = users.id)
        if (Schema::hasColumn('orders', 'user_id') && Schema::hasTable('users')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        // DROP foreign key for table order_details (order_details.user_id = orders.id)
        if (Schema::hasColumn('order_details', 'order_id') && Schema::hasTable('orders')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->dropForeign(['order_id']);
            });
        }

        // DROP foreign key for table order_details (order_details.product_id = products.id)
        if (Schema::hasColumn('order_details', 'product_id') && Schema::hasTable('products')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });
        }

        // DROP foreign key for table order_details (order_details.price_id = prices.id)
        if (Schema::hasColumn('order_details', 'price_id') && Schema::hasTable('prices')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->dropForeign(['price_id']);
            });
        }
    }
}
