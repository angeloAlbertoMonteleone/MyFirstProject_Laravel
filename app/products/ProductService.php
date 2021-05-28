<?php

namespace App\Products;

use Illuminate\Support\Str;

class ProductService
{
    public function __construct()
    {
        if(!session()->has('products')) {
            session()->put('products', [
                [
                    'uuid' => Str::uuid()->toString(),
                    'name' => 'Prodotto 1',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'price' => 99.99,
                    'available' => true
                ],
                [
                    'uuid' => Str::uuid()->toString(),
                    'name' => 'Prodotto 2',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'price' => 99.99,
                    'available' => true
                ],
                [
                    'uuid' => Str::uuid()->toString(),
                    'name' => 'Prodotto 3',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'price' => 99.99,
                    'available' => false
                ],
                [
                    'uuid' => Str::uuid()->toString(),
                    'name' => 'Prodotto 4',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'price' => 99.99,
                    'available' => true
                ],
                [
                    'uuid' => Str::uuid()->toString(),
                    'name' => 'Prodotto 5',
                    'description' => 'Lorem ipsum dolor sit amet',
                    'price' => 99.99,
                    'available' => false
                ],
            ]);
        }
    }

    public static function products(): array
    {
        return session()->get('products');
    }

    public static function product(string $uuid): ?array
    {
        return session()->get('products.'.$uuid);
    }

    public static function addProduct(array $data)
    {
        if(!array_key_exists('uuid', $data)) {
            $data['uuid'] = Str::uuid();
        }

        session()->push('products', $data);
    }

    public static function updateProduct(string $uuid, array $data)
    {
        session()->put('products.'.$uuid, $data);
    }

    public static function deleteProduct(string $uuid)
    {
        session()->forget('products.'.$uuid);
    }
}
