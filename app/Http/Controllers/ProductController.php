<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\CategorieController;

class ProductController extends Controller
{
    public function getproducts() {
        return Product::all();
    }

    public function getProductSortingByPrice($sort,$categorieOrsubCategorie){
        if($categorieOrsubCategorie != 'null'){
            $arraySplit = explode('_',$categorieOrsubCategorie);
            if($arraySplit[0] == 'categorie'){
                return (new CategorieController)->getProductsByCategorie((integer)$arraySplit[1],$sort);
            }else{
                return (new CategorieController)->getProductsBySubCategorie((integer)$arraySplit[1],$sort);
            }
        }else{
            if($sort == 'asc'){
                return Product::orderBy('price')->get();
            }else{
                return Product::orderByDesc('price')->get();
            }
        }
        // return $categorieOrsubCategorie;
    }
}
