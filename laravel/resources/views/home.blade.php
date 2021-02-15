@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- CARD 1 -->
            <div class="card">
                <div class="card-header">Choose image</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data"> {{-- da stringa a file--}}

                        @csrf
                        @method('post')

                        <input name='icon' type="file">

                        <br>
                        <br>

                        <input type="submit" class="btn btn-primary" value="UPDATE">
                        <a href="{{ route('delete') }}" class="btn btn-danger">DELETE</a>
                    </form>
                </div>
            </div>

            
            <!-- CARD 2 -->
            @if (Auth::user() -> icon) {{-- esegue la card 2 solo se c'e' l'icona --}}
                
            <div class="card">
                <div class="card-header">Image</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <img src="/storage/icons/{{ Auth::user() -> icon }}" alt="" width="200px">
                </div>
            @endif
            
        </div>
    </div>
</div>
@endsection
