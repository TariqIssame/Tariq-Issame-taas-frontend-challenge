<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    public function getcategories () {
        return Category::all()->where('parent_categorie',null);
    }

    public function getsubcategories ($id) {
        return Category::all()->where('parent_categorie',$id);
    }

    public function getProductsByCategorie ($id,$sort) {
        $categorie = Category::find($id);
        if($sort != 'null'){
            return $categorie->products()->orderBy('price',$sort)->get();
        }
        return $categorie->products()->get();
    }

    public function getProductsBySubCategorie($id,$sort) {
        $request = 'SELECT pr.*
                    FROM products as pr, product_categorie as prdCtg
                    WHERE prdCtg.child_categorie = ? and pr.id = prdCtg.product_id ';

        if($sort != 'null'){
            $request .= 'order by price '. $sort;
        }

        $categorie = DB::select($request,[$id]);
        return $categorie;
    }

}
