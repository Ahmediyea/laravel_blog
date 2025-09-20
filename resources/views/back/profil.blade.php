@extends('back.layouts.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profilim</h1>

    <div class="row">

        <!-- Profil Kartı -->
       <div class="col-lg-4">
    <div class="card shadow mb-4 text-center">
        <div class="card-body">

            @if ($user->image == null)
                <i class="fas fa-user-circle fa-5x mb-3 text-gray-500"></i>
            @else
                <img src="{{ $user->image }}" class="rounded-circle mb-3" width="150" height="150" alt="Profil Resmi">
            @endif

            <h5 class="font-weight-bold">{{ $user->name }}</h5>
            <p class="text-muted">{{ $user->email }}</p>
            <a href="#" class="btn btn-primary btn-sm">Profili Düzenle</a>
        </div>
    </div>
</div>


        <!-- Bilgi Kartı -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kullanıcı Bilgileri</h6>
                </div>
                <div class="card-body">
                    <p><strong>Ad Soyad:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Üyelik Tarihi:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
