<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class DeleteLowQuantityProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:low-quantity-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $products = Product::where('quantity', '<', 5)->get();

    if ($products->count() > 0) {
        foreach ($products as $product) {
            $product->delete();
        }

        $this->info('Products deleted successfully.');
    } else {
        $this->info('No products found with quantity less than 5.');
    }
}
}
