@extends('layouts.index')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card  border bordered">
                <div class="card-header">
                    <h4 class="mb-0"><span class="text-muted">Daftar Produk</span> <i class="fas fa-angle-right"></i>
                        {{ $type == 'create' ? 'Tambah Produk' : 'Edit Produk' }}</h4>
                </div>
                <div class="card-body">
                    @if ($type == "edit")
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="image" style="width: 8rem;" class="img-thumbnail mt-2">
                        </div>
                        <p class="text-center">Current Image</p>
                    @endif
                    <form action="{{ $type == 'create' ? route('product.store') : route('product.update', $product->id) }}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        @if ($type == "edit")
                            @method("PATCH")
                        @endif
                        <div class="col-12 col-md-4 form-group">
                            <label class="form-label">Kategori</label>
                            <select name="product_category_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ (isset($product) && $product->product_category_id == $item->id) ? "selected" : ""; }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('product_category_id')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8 form-group">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" placeholder="Masukan nama barang" value="{{ old('name',$product->name ?? '') }}" name="name" class="form-control">
                            @error('name')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label class="form-label">Harga Beli</label>
                            <input type="text" placeholder="Masukan harga beli" value="{{ old('buy',$product->buy ?? '') }}" name="buy" class="form-control">
                            @error('buy')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label class="form-label">Harga Jual</label>
                            <input type="text" readonly placeholder="Masukan harga jual" value="{{ old('sell',$product->sell ?? '') }}" name="sell" class="form-control">
                            @error('sell')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label class="form-label">Stok Barang</label>
                            <input type="text" placeholder="Masukan stok barang" name="stock" value="{{ old('stock',$product->stock ?? '') }}" class="form-control">
                            @error('stock')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div>                        
                        <div class="col-12 form-group">
                            <label class="form-label">Upload Image</label>
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">
                                    <img src="{{ asset('img/image.png') }}" alt="image" style="width: 100px;height: 100px;object-fit: cover;">
                                    <h5 class="font-weight-bold mt-2">Upload gambar disini</h5>
                                </label>
                                <input type="file" name="image" id="image-upload" />
                            </div>
                            @error('image')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror                            
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <a href="{{ route('product.index') }}" style="border-color: #174bdb;color: #174bdb;" class="btn btn-batal btn-outline-success mr-2 px-5">Batalkan</a>
                            <button type="submit" style="background-color: #174bdb;border-color: #174bdb;box-shadow: none;" class="btn btn-simpan btn-success px-5">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        .image-preview,
        #callback-preview {
            width: 100%;
            height: 300px;
            border: 2px dashed #174bdb;
            border-radius: 3px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #ecf0f1;
        }

        .image-preview label,
        #callback-preview label {
            position: absolute;
            z-index: 5;
            opacity: 1 !important;
            cursor: pointer;
            background: none !important;
            width: max-content !important;
            height: max-content !important;
            font-size: 12px;
            line-height: 50px;
            text-transform: capitalize !important;
            color: #174bdb !important;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            text-align: center;
        }

        .btn-batal:hover{
            background-color: #174bdb !important;
            border-color: #174bdb !important;
        }
        .btn-simpan:hover{
            background-color: #133eb3 !important;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('template/dist') }}/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js">
    </script>
    <script>
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: null, // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $(document).ready(function(){
            $("input[name='buy']").keyup(() => {
                let val = parseInt($("input[name='buy']").val())
                if (Number.isInteger(val)) {
                    let sell = val+(val*0.30);
                    $("input[name='sell']").val(sell)     
                }else{
                    $("input[name='sell']").val("")     
                    $("input[name='buy']").val("")     
                }
            })
        })
    </script>
@endpush
