
@extends('frontend.layouts.master')
@section('title','productView')
@section('content')




    <livewire:frontend.product.view :cat="$cat" :product="$product"/>




@endsection
