@extends('layouts.appAdmin')
@section('content')
    <h1 class="h1">Nouveau produit</h1>

    @if (session()->has('message'))
    <div class="border border-green 700 text-green-700 bg-green-200 px-1 py-2 rounded">
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
    </div>
    @endif
    <div class="w-11/12 lg:w-2/3 flex justify-center content-center items-center bg-white mt-4 border mb-8">
        <form class="mt-4 lg:mt-8 w-full" action="{{route('ProductAdminController.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('auth.admin.includes.form')
            <div class="class w-full mt-0 lg:mt-4 p-4 flex justify-center">
                <button type="submit" class="btnCAdmin w-full lg:w-60">Ajouter le produit</button>
            </div>
        </form>
    </div>
@endsection