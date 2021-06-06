<?php

namespace App\Products;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

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

    public function products(): array
    {
        return session()->get('products');
    }

    public function product(string $uuid): ?array
    {
      return Arr::first(session()->get('products', []), function ($item) use ($uuid) {
          return $item['uuid'] == $uuid;
        });
    }

    public function addProduct(array $data)
    {
        if(!array_key_exists('uuid', $data)) {
            $data['uuid'] = Str::uuid();
        }

        session()->push('products', $data);

        return $data;
    }

    public function updateProduct(string $uuid, array $data)
    {
        static::deleteProduct($uuid);

        $data = array_merge($data, ['uuid' => $uuid]);

        session()->push('products', $data);

        return $data;
    }

    public function deleteProduct(string $uuid)
    {
      $collect = collect(session()->get('products'))->filter(function($item) use ($uuid) {
        return $item['uuid'] != $uuid;
      });

      session()->put('products', $collect->toArray());

      return $uuid;
    }


    public function findOrFail(string $uuid)
  {
      $product = $this->product($uuid);
      if($product === null) {
          abort(404, 'Il prodotto selezionato NON ESISTE!');
      }

      return $product;
  }
}
