@extends('layouts.app')

@section('content')

<div class="row py-5 px-4 text-dark">
    <div class="col-md-5 mx-auto">
        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><img src="{{ asset("images/$user->image") }}" width="130" class="rounded mb-2 img-thumbnail"></div>
                    <div class="media-body mb-5 text-dark">
                        <h4 class="mt-0 mb-0">{{ $user->tweetname}}</h4>
                        <p class="small mb-4 text-dark"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p>
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center text-dark">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">215</h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>Photos</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">745</h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Followers</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">340</h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Following</small>
                    </li>
                </ul>
            </div>
            <div class="px-4 py-3 ">
                <h5 class="mb-0 text-dark">A propos de moi !</h5>
                <div class="p-4 rounded shadow-sm bg-light text-dark">
                    <p class="font-italic mb-0 text-dark">Web Developer</p>
                    <p class="font-italic mb-0 text-dark">Lives in New York</p>
                    <p class="font-italic mb-0 text-dark">Photographer</p>
                </div>
            </div>
            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Photos récente</h5><a href="#" class="btn btn-link text-muted">Tout afficher</a>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($user->tweets as $tweet)
<div class="container my-5 justify-content-center">
    <div class=" row justify-content-center ">
        <div class="col-lg-6 col-12 mt-5 ">
            <div class="card mt-3 ">
                <div class="layer"></div>
                <div class="content">
                    <div class="card-header text-center border-0">
                        <div class="row justify-content-center my-4">
                            <div class="col">
                                <div class="d-flex flex-lg-row flex-column-reverse no-gutters justify-content-center">
                                    <div class="col-3 text-right"><img class="img-fluid" id="quotes" src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png" width="110" height="110"></div>
                                    <div class="col pr-lg-5"><img class=" img-1 mr-lg-5 " src="{{ asset("images/$user->imageprofil") }}" width="130" class="rounded mb-2 img-thumbnail"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center border-0 mt-0 pt-0 mb-3">
                        <div class="row text-center name mt-auto ">
                            <div class="col">
                                <h4 class="mb-0">{{ $tweet->user->tweetname}}</h4>
                                <p><span class="fa fa-star text-warning mr-1"></span><span class="fa fa-star text-warning mr-1"></span><span class="fa fa-star text-warning mr-1"></span><span class="fa fa-star-half-o text-warning mr-1"></span><span class="fa fa-star-o text-warning mr-1"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center pb-3 ">
                        <div class="row justify-content-center">
                            <div class="col text-center justify-content-center ">
                                <p class="bold text-center px-md-3"> {{ $tweet->content}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col text-center justify-content-center ">
                            <p class="bold text-center px-md-3"><img src="{{ asset("images/$tweet->imageprofil") }}" class="img-fluid rounded shadow-sm"></p>
                        </div>
                    </div>
                    <div class="card-body text-center pb-3 ">
                        <div class="row justify-content-center">
                            <div class="col text-center justify-content-center ">
                                <p class="bold text-center px-md-3">tags : {{ $tweet->tags}}</p>
                            </div>
                        </div>

                    </div>
                    <hr class="mt-auto mb-4">
                    <div class="text-center">
                        @if (Auth::user()->can('update', $tweet))
                        <a href="{{route('tweets.edit',$tweet)}}">
                            <button class="btn-primary">Modifier le tweet</button></a>
                        @endif
                    </div>

                    <div class="text-center">
                        @if (Auth::user()->can('delete', $tweet))
                        <form action="{{route('tweets.destroy',$tweet)}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="supprimer" class="my-2 btn-danger">
                        </form>
                        @endif
                    </div>

                    @foreach($tweet->comments as $comment)
                    <div class="comments ">
                        <div class="d-flex flex-row mb-2">
                            <span class="name"><a href="{{route('profil',$comment->user_id)}}">{{ $comment->user->tweetname}}</a></span>
                            <small class="comment-text">{{ $comment->content}}</small>
                            <small class="comment-text">{{ $comment->tags}}</small>
                        </div>
                        <div class="text-center">
                            @if (Auth::user()->can('update', $comment))
                            <a href="{{route('comments.edit',$comment)}}">
                                <button><i class="fas fa-pencil-alt"></i></button></a>
                            @endif
                        </div>
                        <div class="text-center">
                            @if (Auth::user()->can('delete', $comment))
                            <form action="{{route('comments.destroy',$comment)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="text-danger"> <i class="fas fa-times-circle"></i></button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    <div class="p-2">
                        <form action="{{route('comments.store')}}" method="post">
                            @csrf
                            <div class="comments  text-center my-2">
                                <h3>Commente !</h3>
                                <div class="comment-input"> <input type="text" name="content" class="form-control" placeholder="Comment">
                                    <h3>Tags</h3>
                                    <input type="text" name="tags" class="form-control" placeholder="Tags">
                                    <h3>Joindre une image</h3>
                                    <input type="text" name="image" class="form-control" placeholder="Images">
                                    <input type="hidden" value="{{$tweet->id}}" name="tweet_id">
                                    <input type="submit" value="envoyer" class="my-2 btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
@endsection