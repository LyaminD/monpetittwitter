@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Carnet de bord') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Vous êtes connecté !') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- POSTER UN TWEET-->
<div class="container mt-5 mb-5 text-center">
    <h1>Post ton tweet !</h1>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="p-2">
                    <p class="text-justify">Partagez vos éxpèriences ! avec ou sans photos ! </p>
                    <form action="{{route('tweets.store')}}" method="post">
                        @csrf
                        <div class="tweets">
                            <h3>Ecris ton tweet en dessous</h3>
                            <div class="tweets-input"> <input type="text" name="content" class="form-control" placeholder="Tweet">
                                <h3>Tags</h3>
                                <input type="text" name="tags" class="form-control" placeholder="Tags">
                                <h3>Joindre une image</h3>
                                <input type="text" name="image" class="form-control my-2" placeholder="Images">
                                <button>Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<h1 class="text-center">Fil d'actualité</h1>
<!-- TWEET-->
@foreach ($tweets as $tweet)
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
                                    <div class="col pr-lg-5"><img class=" img-1 mr-lg-5 " src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" alt="..." width="130" class="rounded mb-2 img-thumbnail"></div>
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
                            <p class="bold text-center px-md-3"><img src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm">{{ $tweet->image}}</p>
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
                            <button>Modifier le tweet</button></a>
                        @endif
                    </div>

                    <div class="text-center">
                        @if (Auth::user()->can('delete', $tweet))
                        <form action="{{route('tweets.destroy',$tweet)}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="supprimer" class="my-2">
                        </form>
                        @endif
                    </div>

                    @foreach($tweet->comments as $comment)
                    <div class="comments ">
                        <div class="d-flex flex-row mb-2"> <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" width="40" class="rounded-image">
                            <div class="d-flex flex-column ml-2">
                                <span class="name">{{ $comment->user->tweetname}}</span>
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
                                    <button> <i class="fas fa-times-circle"></i></button>
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
                                        <input type="submit" value="envoyer" class="my-2">
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