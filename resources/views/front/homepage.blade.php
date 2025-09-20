@extends('front.layout.master')
@section('title','Anasayfa')
@section('content')

        <!-- Ana içerik -->
<div class="col-md-9 mx-auto">
@include('front.widgets.articlewidget')
</div>

<!-- Sidebar / Kategori widget -->

@include('front.widgets.CategoryWidget', ['categories' => $categories])

@endsection
