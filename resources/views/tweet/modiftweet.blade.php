@extends('layouts.app')

@section('content')

<form action="{{route('tweets.update',$tweet)}}" method="post">
    @csrf
    @method('PUT')
    <div class="tweets container my-5 justify-content-center">
        <h3>Modifie ton tweet en dessous</h3>
        <div class="tweets-input"> <input type="text" value="{{$tweet->content}}" name="content" class="form-control" placeholder="Tweet">
            <h3>Modifie ton Tags</h3>
            <input type="text" name="tags" class="form-control" value="{{$tweet->tags}}" placeholder="Tags">
            <h3>Modifie ton image</h3>
            <input type="text" name="image" class="form-control" value="{{$tweet->image}}" placeholder="Images">
            <div class="fonts"> <i class="fa fa-camera "></i> </div>
            <button>Modifier</button>
        </div>
    </div>
</form>
@endsection