@extends('layouts.app')

@section('title', 'Data Category')
@section('menuSuperadminCategory', 'active')

@section('content')
   @livewire('superadmin.category.index') 
@endsection
