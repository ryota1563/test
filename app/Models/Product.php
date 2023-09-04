<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = "products";
    public function getList() {

       $products = DB::table('products')
       ->join('companies', 'products.company_id', '=', 'companies.id')
       ->select('companies.*','products.*','companies.company_name')
       ->get();

       return $products;
     }

     public function registArticle($request, $file_name) {


         DB::table('products')->insert([
                   'company_id'=>$request->input('company_id'),
                   'product_name'=>$request->input('product_name'),
                   'price'=>$request->input('price'),
                   'stock'=>$request->input('stock'),
                   'comment'=>$request->input('comment'),
                   'img_path'=>$file_name,
                   'created_at'=> now(),
                   'updated_at'=> now(),
               ]);
       }

      public function showDetail($id)
      {
         $products = Product::find($id);

         return $products;
      }

     public function company()
     {
         return $this->belongsTohasMany('App\Models\Company');
     }

}