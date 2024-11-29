@extends('layouts.index')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="card  border bordered">
            <div class="card-header">
                <img src="{{ asset('img/photo.jpg') }}" class="rounded-circle" alt="Cinque Terre" width="250" height="250"> 
            </div>
            <div class="card-body">
                <h2 class="mb-3 fw-bold">Andrew Gabriel Graceson Sitohang</h2>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="col-12 form-group">
                            <label for="" class="form-label">Nama Kandidat</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{ auth()->user()->name }}">
                            </div>
                        </div>    
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12 form-group">
                            <label for="" class="form-label">Posisi Kandidat</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">&lt;/&gt;</span>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{ auth()->user()->candidate }}">
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection