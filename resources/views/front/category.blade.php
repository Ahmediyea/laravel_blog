@extends('front.layout.master')
@section('title',$category->name.  '  |' .count($articles) .  ' yazı bulundu')
@section('content')

        <!-- Ana içerik -->

        <div class="col-md-9 mx-auto ">


        @include('front.widgets.articlewidget')

    


        </div>

        <!-- Sidebar / Kategori widget -->




@include('front.widgets.CategoryWidget', ['categories' => $categories])

@endsection
