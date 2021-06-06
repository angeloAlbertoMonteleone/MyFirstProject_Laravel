<?php

namespace App\Http\Controllers;

use App\products\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
  private $productService;

  public function __construct(ProductService $productService) {
    $this->productService = $productService;
  }


  public function index() {

    session()->put('cart', collect([
        [
            'uuid' => Str::uuid()->toString(),
            'quantity' => 1,
        ],
        [
            'uuid' => Str::uuid()->toString(),
            'quantity' => 2,
        ]
      ]));

      // giving the view of the cart
    return response()->view('cart.index');
  }

  public function addToCart(Request $request) {
    //adding element to Cart

    // Validate the request
    $this->validate($request, [
      'product' => ['request', 'string', 'uuid']
    ]);

    // recover my product
    $product = $this->productService->product($request->input('product'));

    // if any element are in the cart, generate a new Cart
    if (!session()->has('cart')) {
      session()->put('cart', collect());
    }
  }



  public function updateQuantity() {
    //updating quantity
  }
  public function destroy() {
    // cancel element from the cart
  }
}
