<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products\ProductService;
use Illuminate\Foundation\Validation\ValidatesRequests;


class ProductController extends Controller
{

  use ValidatesRequests;

  private  $service;

    public function __construct(ProductService $service) {
      $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->service->products();

        return \response()->view('products.index', [
          'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      session()->all()->flush();

      $products = $this->service->products();

      return \response()->view('products.create', [
        'products' => $products
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // valid the request
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'available' => ['required']
      ]);

      // add product into the session
      $product = $this->service->addProduct($request->only(['name', 'description', 'price', 'available']));

      // redirect to the route show
      return \response()->redirectToRoute('products.show', ['product' => $product['uuid']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $product = $this->service->product($id);

      if($product === null) {
        return 'The product doesn`t exist';
      }

      return \response()->view('products.show', [
        'product' => $product
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $product = $this->service->product($uuid);
        if($product === null) {
          abort(404, "The selected product doesn`t exist");
        }

        return \response()->view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //valid the request
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'available' => ['required']
      ]);

      // check if the product exists
      $product = $this->service->product($uuid);
      if($product === null) {
        abort(404, "The selected product doesn`t exist");
      }

      // add product into the session
      $data = $this->service->addProduct($request->only(['name', 'description', 'price', 'available']));

      $productInDb = $this->service->updateProduct($product['uuid'], $data);

      // redirect to the route show
      return \response()->view('products.show', ['product' => $product['uuid']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
