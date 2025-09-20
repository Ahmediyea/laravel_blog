@isset($categories)


<div class="col-md-3 mx-auto">
    <div class="card mb-4">
        <div class="card-header">Kategoriler</div>
        <ul class="list-group list-group-flush">
            @foreach ($categories as $category)
                
                <li class="list-group-item d-flex justify-content-between align-items-center @if (Request::segment(2)==$category->slug) active @endif">
                    <a @if (Request::segment(2)!=$category->slug) href={{route('category',$category->slug)}} @endif >{{ $category->name }}</a>
                    <span class="badge rounded-pill bg-danger">{{$category->articlecount()}}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
