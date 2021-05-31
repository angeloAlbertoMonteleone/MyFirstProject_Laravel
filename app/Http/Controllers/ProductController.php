<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products\ProductService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidationException;


class ProductController extends Controller
{

  use ValidatesRequests;

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
      // valid the request
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric', 'max:0'],
        'availability' => ['nullable']
      ])

      // add product into the session
      $addedProduct = $this->service->addProduct($request->only(['name', 'description', 'price', 'availability']));

      return responce()->redirectToRoute('products.show', [
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
      $productsArray = $this->service->products();

      return \response()->view('products.show', [
        'product' => $id
      ]);
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
