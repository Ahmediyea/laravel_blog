@extends('back.layouts.master')
@section('title', '"' . $article->title . '"' . ' makalesini Güncelle')
@section('content')

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><strong>İşlem Tablosu</strong></h6>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            @endif
                            <form method="POST" action="{{ route('admin.makaleler.update',$article->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label >Makale Başlığı</label>
                                    <input type="text"  name="title" class="form-control" style="color:#000; font-weight:500;" required placeholder="Makale başlığını girin" value="{{$article->title}}">
                                </div>
                                <div class="form-group">

                                    <label >Makale İçeriği</label>
                                    <select name="category" class="form-control" required>
                                        <option value="">Kategori Seçiniz</option>
                                        @foreach ($categories as $category )

                                            <option @if($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group ">

                                    <label>Makale Fotoğrafı</label><br>
                                    <img  src="{{asset($article->image)}}" class="img-thumbnail rounded" width="300" class="mb-2">
                                    <input type="file" name="image"  class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>Makele İçeriği</label>
                                    <textarea name="content" id="editor" class="form-control" rows="4" required placeholder="Makale içeriğini girin" >{!!$article->content!!}</textarea>

                                </div>

                                <div class="form-group">
                                    <button tybe="submit " class="btn btn-primary btn-block">Makaleyi Güncelle</button>

                                </div>


                            </form>
                        </div>




    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
   $(document).ready(function() {
  $('#editor').summernote({
    height: 300, // Set the height of the editor
    placeholder: 'Makale içeriğini buraya yazın...' // Placeholder text
  });
});

</script>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
@endsection
