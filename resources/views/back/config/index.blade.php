@extends('back.layouts.master')
@section('title', 'Ayarlar')
@section('name')
@section('content')

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">İşlem Tablosu




                        </div>
                        <div class="card-body">
                               <form method="POST" action="{{route('admin.config.update')}} " enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Site Başlığı</label>
                                            <input type="text" name="title" required class="form-control" value="{{$config->title}}">

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Site Aktiflik Durumu</label>
                                            <select name="active" id="" class="form-control">
                                                <option @if ($config->active==1)selected @endif value="1">Açık</option>
                                                <option @if ($config->active==0) selected @endif value="0">Kapalı</option>
                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Site Logo</label>
                                            <input type="file" name="logo"  class="form-control" >

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Site Favicon</label>
                                            <input type="file" name="favicon"  class="form-control" >

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" name="facebook" value="{{$config->facebook}}" class="form-control" >

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">İnstagram</label>
                                            <input type="text" name="instagram" value="{{$config->instagram}}" class="form-control" >

                                        </div>

                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Youtube</label>
                                            <input type="text" name="youtube" value="{{$config->youtube}}" class="form-control" >

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">X</label>
                                            <input type="text" name="x" value="{{$config->X}}" class="form-control" >

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  for="">LinkIn</label>
                                            <input type="text" name="linkedin" value="{{$config->linkedin}}" class="form-control" >

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Github</label>
                                            <input type="text" name="github" value="{{$config->github}}" class="form-control" >

                                        </div>

                                    </div>

                                </div>
                                <br>
                                <div class="form-group">
                                    <button tybe="submit " class="btn btn-primary btn-block">Gönder</button>

                                </div>
                               </form>


@endsection
