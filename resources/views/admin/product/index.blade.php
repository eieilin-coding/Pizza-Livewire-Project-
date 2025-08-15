@extends('layouts.app')

@section('title', 'Data Product')
@section('menuAdminProduct', 'active')

@section('content')
   @livewire('superadmin.product.index') 
@endsection
