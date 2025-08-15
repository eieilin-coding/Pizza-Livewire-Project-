@extends('layouts.app')

@section('title', 'Data Permission')
@section('menuSuperadminPermission', 'active')

@section('content')
   @livewire('superadmin.permission.index') 
@endsection
