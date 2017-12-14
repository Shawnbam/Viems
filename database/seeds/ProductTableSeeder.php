<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath' => 'https://fthmb.tqn.com/8cdFIfAhwNAdNAJelEebxEhrmTI=/735x0/success-56a9fd1f3df78cf772abee09.jpg',
            'title' => 'Harry',
            'description' => 'Puttar',
            'price' => '10'
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://fthmb.tqn.com/rKzIYn1qHYakm68y5MGQtWch-fQ=/768x0/filters:no_upscale()/ggg-580734603df78cbc28f46d37.PNG',
            'title' => 'YoYo',
            'description' => 'Honey',
            'price' => '50'
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://i.imgflip.com/1l0s35.jpg',
            'title' => 'Singh saab',
            'description' => 'the great',
            'price' => '500'
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://i0.kym-cdn.com/photos/images/facebook/001/217/729/f9a.jpg',
            'title' => 'lol',
            'description' => 'ok',
            'price' => '111'
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://lh3.googleusercontent.com/YN836O3aUA0_6SBU76kIyd7RT_qyg9K1ol__lll6AXOh1XIhx3akXeRbtT7qpB4g6Y0=h900',
            'title' => 'ok bye',
            'description' => 'thats so girlish',
            'price' => '10001'
        ]);
        $product->save();
        $product = new \App\Product([
            'imagePath' => 'https://images-cdn.9gag.com/photo/ay85OpW_700b.jpg',
            'title' => 'I agree',
            'description' => 'With you',
            'price' => '121'
        ]);
        $product->save();

    }
}
