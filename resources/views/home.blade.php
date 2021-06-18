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
<!-- Search widget-->
<div class="card mb-4 container my-5 justify-content-center">
    <div class="card-header">Recherche se que tu veux !</div>
    <div class="card-body">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
        </div>
    </div>
</div>

<!-- POSTER UN TWEET-->
<div class="container mt-5 mb-5">
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
                                <input type="text" name="image" class="form-control" placeholder="Images">
                                <div class="fonts"> <i class="fa fa-camera "></i> </div>
                                <button>Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<h1>Fil d'actualité</h1>
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
                    <div class="text-center"> <a href="{{route('tweets.edit',$tweet)}}"> <button>Modifier le tweet</button></a></div>
                    <div class="comments">
                        <div class="d-flex flex-row mb-2"> <img src="/public/images/image1.jpg" width="40" class="rounded-image">
                            <div class="d-flex flex-column ml-2"> <span class="name">Daniel Frozer</span> <small class="comment-text">I like this alot! thanks alot</small>
                                <div class="d-flex flex-row align-items-center status"> <small>Like</small> <small>Reply</small><small>18 mins</small> </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-2"> <img src="/public/images/image1.jpg" width="40" class="rounded-image">
                            <div class="d-flex flex-column ml-2"> <span class="name">Elizabeth goodmen</span> <small class="comment-text">Thanks for sharing!</small>
                                <div class="d-flex flex-row align-items-center status"> <small>Like</small> <small>Reply</small><small>8 mins</small> </div>
                            </div>
                        </div>
                        <div class="comment-input"> <input type="text" class="form-control">
                            <div class="fonts"> <i class="fa fa-camera"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection