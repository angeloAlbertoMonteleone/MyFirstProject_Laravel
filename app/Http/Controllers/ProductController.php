<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products\ProductService;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
  private $service;

    public function __construct() {
      $this->service = new ProductService();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsArray = $this->service->products();

        return \response()->view('products.index', [
          'products' => $productsArray
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $productsArray = $this->service->products();

      return \response()->view('products.create', [
        'products' => $productsArray
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
      $validator = Validator::make($request->all(), [
        'uuid' => 'required',
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'availability' => 'required'
      ]);

      if($request->input('price') !== int){
          Validation::make($request->all(), [
            'price' => ['numeric']
          ])->validate();
      }

      // if the request fails, return an exception
      if($validator->fails()) {
        throw new ValidationException($validator);
      }

      $addProductIntoArray = $this->service->addProduct($request->session()->input('uuid'));

      return responce()->view('products.show', [
        'createdProduct' => $addProductIntoArray
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
