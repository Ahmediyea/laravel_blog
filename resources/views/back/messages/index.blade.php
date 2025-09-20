@extends('back.layouts.master')
@section('title','Mesajlar')

@section('content')

@if(count($contacts)>0)
@foreach ($contacts as $contact)


<div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center">
            <i class="fas fa-user-circle fa-3x mr-2"></i>
            <h6 class="m-0 font-weight-bold text-primary">{{ $contact->name }}</h6>

            <div class="ml-auto d-flex">
        <a  contact-id={{$contact->id}} class="btn btn-success btn-sm mr-2 font-weight-bold edit-click" data-toggle="modal" data-target="#editModal"> Yanıtla </a>
        <a href={{route('admin.message.delete',$contact->id)}}  title="Sil"  class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> Sil
        </a>
    </div>
        </div>

        <div class="card-body">
            <div class="text-primary d-inline-block">Kullancı mesajı:</div>
            {{ $contact->message }}
            <br>
            <br>
            <div class="text-primary d-inline-block">Kullanıcı emaili: </div>
            {{$contact->email}}

        </div>




</div>
@endforeach
@else
<div class="alert alert-danger">
        <h1>Hiç bir mesaj bulunmamaktadır</h1>
    </div>
@endif
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title float-left">Yanıtla</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
            @csrf
            <div class="form-group">
                <label>Kategori Adı:</label>
                <input id="contact" type="text" class="form-control" name="category"required >
                <input id="contact-id" type="hidden"  name="id" >
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
 <div class="d-flex justify-content-center">
        {{ $contacts->links('pagination::bootstrap-4') }}
    </div>


<script>
    $(function(){
        $('.edit-click').click(function(){
        id = $(this)[0].getAttribute('contact-id');
        $.ajax({
            type: 'GET',
            url: ,
            data: {id: id},
            success: function(data) {
            console.log(data);
            $('#editModal').modal();



            }
        }); // ajax kapanışı
    });
});



</script>
@endsection

