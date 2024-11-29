<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $where = ($request->kategori == "all") ? "product_category_id != 0" : "product_category_id = ". $request->kategori;
            $where .= ($request->cari != null) ? " AND name LIKE '%".$request->cari."%'" : "";
            $data = Product::with('category')->whereRaw($where)->orderBy('name','ASC');
            return DataTables::of($data)->addIndexColumn()
                    ->addColumn('image', function($row){
                        $btn = '<img src="'. asset('storage/'.$row->image) .'" style="width:3rem;" class="img-fluid"/>';
                        return $btn;
                    })
                    ->addColumn('category', function($row){
                        return $row->category->name;
                    })
                    ->addColumn('buy', function($row){
                        return number_format($row->buy,0,'.',',');
                    })
                    ->addColumn('sell', function($row){
                        return number_format($row->sell,0,'.',',');
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="d-flex justify-content-center">
                            <a href="'.route('product.edit',$row->id).'" class="mr-2 btn" style="color:#174bdb;"><i class="fas fa-pen"></i></a>
                            <form action="'.route('product.destroy',$row->id).'" method="post">
                            '. method_field("DELETE") .'
                            '. csrf_field() .'
                                <button class="text-danger btn" onclick="return confirm(`Apakah anda yakin ingin menghapusnya?`)"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>';
                        return $btn;
                    })
                    ->rawColumns(['action','image'])
                    ->make(true);
        }
        $title = "Product - SIMS Webp App";
        $active = "product";
        $kategori = ProductCategory::all();
        return view("product.index",compact('title','active','kategori'));
    }

    public function create(){
        $title = "Create Product - SIMS Webp App";
        $active = "product";
        $kategori = ProductCategory::all();
        $type = "create";
        return view("product.forms",compact('title','active','kategori','type'));
    }

    public function edit(Product $product){
        $title = "Edit Product - SIMS Webp App";
        $active = "product";
        $kategori = ProductCategory::all();
        $type = "edit";
        return view("product.forms",compact('title','active','kategori','product','type'));
    }
    
    public function export(Request $request){
        $where = ($request->kategori == "all") ? "product_category_id != 0" : "product_category_id = ". $request->kategori;
        $where .= ($request->cari != null) ? " AND name LIKE '%".$request->cari."%'" : "";
        $data = Product::with('category')->whereRaw($where)->orderBy('name','ASC')->get();
        return Excel::download(new ProductExport($data),"Daftar Produk.xlsx");
    }

    public function store(Request $request){
        $data = $request->validate([
            "name" => "required|unique:products,name",
            "buy" => "required|integer",
            "sell" => "required|integer",
            "stock" => "required|integer",
            "image" => "required|mimes:jpg,png|max:100",
            "product_category_id" => "required",
        ]);
        $data['image'] = $request->image->store('products');
        Product::create($data);
        return redirect(route('product.index'))->with('success','Product added successfully');
    }

    public function update(Request $request,Product $product){
        $data = $request->validate([
            "name" => "required|unique:products,name,".$product->id,
            "buy" => "required|integer",
            "sell" => "required|integer",
            "stock" => "required|integer",
            "image" => "mimes:jpg,png|max:100",
            "product_category_id" => "required",
        ]);
        if ($request->image) {
            $data['image'] = $request->image->store('products');
            Storage::delete($product->image);
        }
        $product->update($data);
        return redirect(route('product.index'))->with('success','Product updated successfully');
    }
    
    public function destroy(Product $product){
        Storage::delete($product->image);
        $product->delete();
        return redirect(route('product.index'))->with('success','Product deleted successfully');
    }
}
