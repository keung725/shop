@extends('layouts.app')

@section('title', 'Home')

@section('content')

@include('banner')

@include('product.favo_products')

@include('category.favo_category')

@include('layouts.overlay')

@include('member.nav_login')

@include('member.nav_signup')

@endsection
