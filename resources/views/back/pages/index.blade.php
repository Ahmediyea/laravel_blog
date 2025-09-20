@extends('back.layouts.master')
@section('title', 'Tüm Makaleler')
@section('name')
@section('content')

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">İşlem Tablosu
                                <span class="m-0 float-right font-weight-bold text-primary">{{count($pages)}} Makale<span>

                            <a href="{{route('admin.makaleler.trashed')}}" class="btn btn-warning btn-sm" ><i class="fa fa-trash"></i> Silinen Makaleler</a>

                                </h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sıralama</th>
                                            <th>Fotoğraf</th>
                                            <th>Sayfa Başlığı</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>
                                        </tr>


                                    <tbody id="orders">
                                        @foreach ($pages as $page )
                                        <tr id="page_{{$page->id}}">
                                        <td style="width: 3%" class="text-center">
                                            <i class="fa fa-arrows-alt-v fa-3x handle" style="cursor: move" ></i>


                                        </td>
                                            <td>
                                                <a href="{{route('admin.page.edit', $page->id)}}">
                                                <img   src="{{asset($page->image)}}" width="200">
                                                </a>
                                            </td>
                                            <td >{{$page->title}} </td>

                                            <td>
                                                <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-offstyle="danger" data-off="Pasif" @if ($page->status==1) checked

                                                @endif  data-toggle="toggle">
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('admin.page.edit', $page->id)}}" title="Düzenle" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
                                                <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>

$('#orders').sortable({
    handle: '.handle',
    update: function () {
         var siralama =$('#orders ').sortable('serialize');

         $.get("{{route('admin.page.orders')}}?"+siralama,function(data,status){});
    }
 });

</script>
<script>
$(function() {
    $('.switch').change(function() {
        let id = $(this)[0].getAttribute('page-id');
        let statu = $(this).prop('checked') ? 1 : 0;

        $.get("{{ route('admin.page.switch') }}", {id: id, statu: statu}, function(data, status) {
            console.log(data); // opsiyonel: response kontrolü
        });
    });
});
</script>
@endsection
