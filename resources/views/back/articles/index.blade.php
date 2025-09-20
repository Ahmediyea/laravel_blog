@extends('back.layouts.master')
@section('title', 'Tüm Makaleler')
@section('name')
@section('content')

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">İşlem Tablosu
                                <span class="m-0 float-right font-weight-bold text-primary">{{count($articles)}} Makale<span>

                            <a href="{{route('admin.makaleler.trashed')}}" class="btn btn-warning btn-sm" ><i class="fa fa-trash"></i> Silinen Makaleler</a>

                                </h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Fotoğraf</th>
                                            <th>Makale Başlığı</th>
                                            <th>Kategori</th>
                                            <th>Hit</th>
                                            <th>Oluşturma Tarihi</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                        </tr>


                                    <tbody>
                                        @foreach ($articles as $article )

                                            <td>
                                                <a href="{{route('admin.makaleler.edit', $article->id)}}">
                                                <img   src="{{asset($article->image)}}" width="200">
                                                </a>
                                            </td>
                                            <td >{{$article->title}} </td>
                                            <td>{{$article->getCategory->name}}</td>
                                            <td>{{$article->hit}}</td>
                                            <td>{{$article->created_at->diffForHumans()}}</td>
                                            <td>
                                                <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-offstyle="danger" data-off="Pasif" @if ($article->status==1) checked

                                                @endif  data-toggle="toggle">
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="Görüntüle" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('admin.makaleler.edit', $article->id)}}" title="Düzenle" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
                                                <a href="{{route('admin.delete.article', $article->id)}}" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
$(function() {
    $('.switch').change(function() {
        let id = $(this)[0].getAttribute('article-id');
        let statu = $(this).prop('checked') ? 1 : 0;

        $.get("{{ route('admin.switch') }}", {id: id, statu: statu}, function(data, status) {
            console.log(data); // opsiyonel: response kontrolü
        });
    });
});
</script>
@endsection
