@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    {{ Auth::user()->email }}
                    @foreach ($posts as $post)
                        @if($post->public)
                            <div class="card p-3 mb-3">
                                <p class="card-text">{{ $post->content }}</p>
                                <div class="hstack gap-3">
                                    @if(Auth::user()->id == $post->user_id)
                                        <form method="get" action="{{ route('post.edit', ['postId' => $post->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-warning" action="submit">Редактировать пост</button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->id == $post->user_id or Auth::user()->isAdmin)
                                        <form method="post" action="{{ route('post.delete', ['id' => $post->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button  class='btn btn-danger' type="submit">Удалить пост</button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->isAdmin)
                                        @if($post->public)
                                            <form method="post" action="{{ route('post.unpublic', ['id' => $post->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Снять с публикации</button>
                                            </form>
                                        @else
                                            <form method="post" action="{{ route('post.public', ['id' => $post->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Опубликовать</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                                <h4>Комментарии:</h2>
                                <div class="card p-3 mb-3">
                                    <ul class="list-group list-group-flush">
                                        @foreach($post->comments as $comment)
                                            <li class="list-group-item">
                                                <p class="fw-light">{{ $comment->user->email }}</p>
                                                <p>{{ $comment->content }}</p>
                                                @if(Auth::user()->isAdmin)
                                                    <form method="post" action="{{ route('comment.delete', ['id' => $post->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class='btn btn-danger' type="submit">Удалить комментарий</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <form method="post" action="{{ route('comment.add', ['postId' => $post->id]) }}" class="mb-3">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="form-group">
                                        <textarea class="form-control mb-3" name="content" placeholder="Введите комментарий"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Добавить комментарий</button>
                                </form>
                            </div>
                        @elseif(Auth::user()->isAdmin || Auth::user()->id == $post->user_id)
                            <div class="card p-3 mb-3">
                                <p class="card-text">{{ $post->content }}</p>
                                <div class="hstack gap-3">
                                    @if(Auth::user()->id == $post->user_id)
                                        <form method="get" action="{{ route('post.edit', ['postId' => $post->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-warning" action="submit">Редактировать пост</button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->id == $post->user_id or Auth::user()->isAdmin)
                                        <form method="post" action="{{ route('post.delete', ['id' => $post->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button  class='btn btn-danger' type="submit">Удалить пост</button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->isAdmin)
                                        @if($post->public)
                                            <form method="post" action="{{ route('post.unpublic', ['id' => $post->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Снять с публикации</button>
                                            </form>
                                        @else
                                            <form method="post" action="{{ route('post.public', ['id' => $post->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Опубликовать</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                                <h4>Комментарии:</h2>
                                <div class="card p-3 mb-3">
                                    <ul class="list-group list-group-flush">
                                        @foreach($post->comments as $comment)
                                            <li class="list-group-item">
                                                <p class="fw-light">{{ $comment->user->email }}</p>
                                                <p>{{ $comment->content }}</p>
                                                @if(Auth::user()->isAdmin)
                                                    <form method="post" action="{{ route('comment.delete', ['id' => $post->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class='btn btn-danger' type="submit">Удалить комментарий</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <form method="post" action="{{ route('comment.add', ['postId' => $post->id]) }}" class="mb-3">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="form-group">
                                        <textarea class="form-control mb-3" name="content" placeholder="Введите комментарий"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Добавить комментарий</button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                    <a href="{{ url('/post/create') }}" class="btn btn-primary">Создать пост</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
