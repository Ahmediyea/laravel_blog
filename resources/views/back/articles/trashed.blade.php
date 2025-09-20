@extends('back.layouts.master')
@section('title', 'Silinen Makaleler')
@section('name')
@section('content')

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">İşlem Tablosu
                                <span class="m-0 float-right font-weight-bold text-primary">{{count($articles)}} Makale<span>

                            <a href="{{route('admin.makaleler.index')}}" class="btn btn-success btn-sm" ><i ></i> Aktif Makaleler</a>

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
                                            <th>İşlemler</th>
                                        </tr>


                                    <tbody>
                                        @foreach ($articles as $article )

                                            <td>
                                                <img src="{{asset($article->image)}}" width="200">
                                            </td>
                                            <td >{{$article->title}} </td>
                                            <td>{{$article->getCategory->name}}</td>
                                            <td>{{$article->hit}}</td>
                                            <td>{{$article->created_at->diffForHumans()}}</td>

                                            <td>

                                                <a href="{{route('admin.recover.article', $article->id)}}" title="Geri getir" class="btn btn-primary btn-sm"><i class="fa fa-recycle"></i></a>
                                                <a href="{{route('admin.hard.delete.article', $article->id)}}" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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



    $('.remove-click').click(function(){
        id = $(this)[0].getAttribute('category-id');
        count = $(this)[0].getAttribute('category-count');
        name = $(this)[0].getAttribute('category-name');

        if(id==1){
            $('#articleAlert').html(name+' kategorisi silinemez,Silinen kategorilere ait makaleler Genel kategorisine taşınır.')
            $('#deleteModal').modal();
            $('#deleteButton').hide();


            return;

        }


        $('#deleteButton').show();
        $('#deleteİd').val(id);
        $('#articleAlert').html('');
        if (count>0) {
            $('#articleAlert').html('Bu kategoriye ait '+count+' makale bulunmaktadır silmek istediğinize emin misiniz?.');

        } else {
            $('#articleAlert').html('Bu kategoriyi silmek istediğinize emin misiniz?');

        }
        $('#deleteModal').modal();

});

</script>


@endsection
