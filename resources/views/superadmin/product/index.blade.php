@extends('layouts.app')

@section('title', 'Data Product')
@section('menuSuperadminProduct', 'active')

@section('content')
   @livewire('superadmin.product.index') 
@endsection
