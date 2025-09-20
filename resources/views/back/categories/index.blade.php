@extends('back.layouts.master')
@section('title', 'Tüm Makaleler')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                               <div class="card-header py-3" >
                                <h6 class="m-0 font-weight-bold text-primary">Yeni kategori oluştur</h6>
                               </div>


                                <!-- Card Content - Collapse -->

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('admin.category.create') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Kategori Adı:</label>

                                                <input type="text" class="form-control" name="category" required>
                                            </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block mt-2">Ekle</button>
                                                </div>





                                        </form>
                                    </div>

                            </div>


    </div>

     <div class="col-md-8">
        <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Tüm Kategoriler</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kategr adı</th>
                                            <th>Makaleler</th>
                                            <th>Durum</th>
                                            <th>İşlemler</th>


                                        </tr>


                                    <tbody>
                                        @foreach ($categories as $category )


                                            <td >{{$category->name}} </td>
                                             <td >{{$category->articleCount()}}</td>

                                            <td>
                                                <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-onstyle="success" data-offstyle="danger" data-off="Pasif" @if ($category->status==1) checked

                                                @endif  data-toggle="toggle">
                                            </td>

                                            <td class="d-flex">
                                                <a category-id="{{$category->id}}" title="Düzenle" class="btn btn-primary btn-sm w-50 edit-click"><i class="fa fa-pen"></i></a>
                                                <a category-id="{{$category->id}}"category-name="{{$category->name}}" category-count="{{$category->articlecount()}}" title="Sil"  class="btn btn-danger btn-sm w-50 remove-click"><i class="fa fa-trash"></i></a>

                                            </td>


                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                                    </div>
                                </div>
                            </div>


    </div>




</div>
<!-- Trigger the modal with a button -->

<!--Edit Modal -->

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title float-left">Kategori Düzenle</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.category.update') }}">
            @csrf
            <div class="form-group">
                <label>Kategori Adı:</label>
                <input id="category" type="text" class="form-control" name="category"required >
                <input id="category_id" type="hidden"  name="id" >
            </div>
                <div class="form-group ">
                <label>Kategori Slug:</label>
                <input id="slug" type="text" class="form-control" name="slug"  >
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success" >Kaydet</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!--Delete Modal -->

<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title float-left">Kategori Sil</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="articleAlert"></div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>

        <form method="post" action="{{ route('admin.category.delete') }}">
            @csrf
            <input id="deleteİd" type="hidden"  name="id" >
            <button id="deleteButton" type="submit" class="btn btn-success" >Sil</button>
        <form>
      </div>
    </div>
    </form>
  </div>
</div>



@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
$(function() {

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







    $('.switch').change(function() {
        let id = $(this)[0].getAttribute('category-id');
        let statu = $(this).prop('checked') ? 1 : 0;

        $.get("{{ route('admin.category.switch') }}", {id: id, statu: statu}, function(data, status) {
            console.log(data); // opsiyonel: response kontrolü
        });
    });


      $('.edit-click').click(function(){
        id = $(this)[0].getAttribute('category-id');
        $.ajax({
            type: 'GET',
            url: '{{ route('admin.category.getdata') }}',
            data: {id: id},
            success: function(data) {
            console.log(data);
            $('#category').val(data.name);
            $('#slug').val(data.slug);
            $('#category_id').val(data.id);
            $('#editModal').modal();



            }
        }); // ajax kapanışı
    });
});

</script>
@endsection
