@extends('layouts.app')

@section('content')

<form action="{{route('comments.update',$comment)}}" method="post">
    @csrf
    @method('PUT')
    <div class="comments container my-5 justify-content-center">
        <h3>Modifie ton commentaire en dessous</h3>
        <div class="comments-input"> <input type="text" value="{{$comment->content}}" name="content" class="form-control" placeholder="Comment">
            <h3>Modifie ton Tags</h3>
            <input type="text" name="tags" class="form-control" value="{{$comment->tags}}" placeholder="Tags">
            <h3>Modifie ton image</h3>
            <input type="text" name="image" class="form-control" value="{{$comment->image}}" placeholder="Images">
            <div class="fonts"> <i class="fa fa-camera "></i> </div>
            <button>Modifier</button>
        </div>
    </div>
</form>
@endsection