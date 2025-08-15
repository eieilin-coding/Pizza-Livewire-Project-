@extends('layouts.app')

@section('title', 'Data Role')
@section('menuSuperadminRole', 'active')

@section('content')
   @livewire('superadmin.role.index') 
@endsection
