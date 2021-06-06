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

      return \response()->view('products.create');
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
      $this->validateRequest($request);

      $this->validateRequest($request);
      // add product into the session
      $product = $this->service->addProduct($this->formattedDataFrom($request));

      // flash message to confirm the storage
      $request->session()->flash('message', sprintf('the product %s has been added', $product['name']));

      // redirect to the route show
      return redirect()->route('products.index');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {

      $product = $this->service->findOrFail($uuid);

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
        $product = $this->service->findOrFail($uuid);

        return \response()->view('products.edit', ['product' => $product]);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
      //valid the request
      $this->validateRequest($request);

      // check if the product exists
      $product = $this->service->findOrFail($uuid);

      $data = $this->formattedDataFrom($request);

      // add product into the session
      $product = $this->service->updateProduct($product['uuid'], $data);

      // flash message to confirm the storage
      $request->session()->flash('message', sprintf('the product %s has been updated', $product['name']));


      // redirect to the route show
      return redirect()->route('products.index');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
      // check if the product exists
      $product = $this->service->findOrFail($uuid);

      // delete product
      $this->service->deleteProduct($product['uuid']);

      // flash message to confirm the storage
      session()->flash('message', sprintf('the product %s has been cancelled', $product['name']));

      // redirect to the route show
      return redirect()->route('products.index');
    }





    private function validateRequest(Request $request) {

      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric', 'min:0'],
        'available' => ['required']
      ]);
    }

    private function formattedDataFrom(Request $request): array
 {
     return $request->only(['name', 'description', 'price', 'available']);
 }

}
