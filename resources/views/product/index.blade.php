@extends('layouts.index')
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card  border bordered">
                <div class="card-header">
                    <h4 class="mb-0">Daftar Produk</h4>
                </div>
                <div class="card-body">
                    @session('success')
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endsession
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <div class="input-group mb-4">
                                        <span style="border-right: none;" class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input style="border-left: none;" type="text" id="cari" class="form-control" placeholder="Cari barang" aria-label="Cari barang" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="input-group">
                                        <span style="border-right: none;color: #000;" class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                                        <select style="border-left: none;" class="form-control" id="kategori">
                                            <option value="all">Semua</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8">
                            <div class="d-flex align-items-center justify-content-end">
                                <a href="" class="btn btn-success mr-2" id="ekspor"><i class="fas fa-download"></i> Export Excel</a>
                                <a href="{{ route('product.create') }}" class="btn btn-danger"><i class="fas fa-plus-circle"></i> Tambah Produk</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped data-table text-center w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Image</th>
                                    <th class="align-middle">Nama Produk</th>
                                    <th class="align-middle">Kategori Produk</th>
                                    <th class="align-middle">Harga Beli (Rp)</th>
                                    <th class="align-middle">Harga Jual (Rp)</th>
                                    <th class="align-middle">Stok Produk</th>
                                    <th class="align-middle">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <style>
        .form-control,.input-group-text{
            color: #dee2e6;
            border-radius: 0px !important;
        }   
        .form-control::placeholder{
            color: #dee2e6;
        }     
        .form-control:focus{
            box-shadow: none !important;
            border-color: #dee2e6
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('template/dist') }}/assets/modules/datatables/datatables.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">
    </script>
    <script>
        function setUrlEksport() {
            let kategori = $("#kategori").val();
            let cari = $("#cari").val();
            console.log(cari);
            $("#ekspor").attr("href",`{{ route('product.export') }}?kategori=${kategori}&cari=${cari}`)
        }
        function dataDraw(){
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "bFilter": false,
                dom:"rtip",
                ajax: {
                    url:"{{ route('product.index') }}",
                    data:{
                        "kategori" : $("#kategori").val(),
                        "cari" : $("#cari").val(),
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: "align-middle",
                        orderable: false, searchable: false
                    },
                    {
                        data: 'image',
                        class: "align-middle",
                        name: 'image'
                    },
                    {
                        data: 'name',
                        class: "align-middle",
                        name: 'name'
                    },
                    {
                        data: 'category',
                        class: "align-middle",
                        name: 'category'
                    },
                    {
                        data: 'buy',
                        class: "align-middle",
                        name: 'buy'
                    },
                    {
                        data: 'sell',
                        class: "align-middle",
                        name: 'sell'
                    },
                    {
                        data: 'stock',
                        class: "align-middle",
                        name: 'stock'
                    },
                    {
                        data: 'action',
                        class: "align-middle",
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        }
        $(function() {
            dataDraw()
            setUrlEksport()
            $("#kategori").change((table) => {
                $(".data-table").dataTable().fnDestroy()
                dataDraw()
                setUrlEksport()
            })
            $("#cari").change((table) => {
                $(".data-table").dataTable().fnDestroy()
                dataDraw()
                setUrlEksport()
            })
        });
    </script>
@endpush
