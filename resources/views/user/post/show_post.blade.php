@extends('user.layouts.user')

@section('title')
<title>{{ trans('me.post') }}</title>
@endsection

@section('content')
<main id="main">

    <div class="container">

        <div class="row topspace">
            <div class="col-sm-8 col-sm-offset-2">

                <article class="post">
                    <header class="entry-header">
                        <div class="entry-meta">
                            <span class="posted-on"><time class="entry-date published" date="2013-06-17">{{
                                    $post->created_at }}</time></span>
                        </div>
                        <h1 class="entry-title">{{ $post->title }}</a></h1>
                    </header>
                    <div class="entry-content">
                        <p><img alt="" src="{{ asset('storage/post/' . $post->images) }}"></p>
                        <p>
                            {!! $post->content !!}
                        </p>
                    </div>
                </article>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <div id="comments">
                    <h3 class="comments-title"> {{ trans('me.comment') }}</h3>
                    <p class="leave-comment">{{ trans('me.leave_comment') }}</p>
                    @foreach ($comments as $comment)

                    <ol class="comments-list">
                        <li class="comment" id="comment-{{ $comment->id }}">
                            <div class="parent-comment" id="parent-comment-{{ $comment->id }}">
                                <img src="{{ asset('storage/user/' . optional($comment->user)->avatar) }}" alt="Avatar"
                                    class="avatar">

                                <div class="comment-meta">
                                    <span class="author">{{ optional($comment->user)->full_name
                                        }}</span>
                                    <span class="date">{{ $comment->created_at }}</span>
                                    <span class="reply" data-id="{{ $comment->id }}">{{
                                        trans('me.reply')
                                        }}</span>
                                    <span class="edit" data-id="{{ $comment->id }}">{{
                                        trans('me.edit')
                                        }}</span>
                                    <span class="delete" data-id="{{ $comment->id }}">{{
                                        trans('me.delete')
                                        }}</span>
                                </div>

                                <div class="comment-body">
                                    {{ $comment->content }}
                                </div>
                            </div>

                            <div class="eidt-parent-comment" id="edit-parent-comment-{{ $comment->id }}">
                                <form action="{{ route('comment.update', ['id' => $comment->id]) }}" method="post"
                                    id="commentform">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="inputComment">{{ trans('me.comment') }}</label>
                                        <textarea class="form-control" rows="6" name="content"
                                            id="content">{{ $comment->content }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <button type="submit" class="btn btn-action">{{ trans('me.submit')
                                                }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <ul class="children">
                                @foreach ($comment->getChilComment as $chilComment)
                                <li class="comment" id="comment-reply-{{ $chilComment->id }}">
                                    <div class="children-comment" id="children-comment-{{ $chilComment->id }}">
                                        <img src="{{ asset('storage/user/' . optional($chilComment->user)->avatar) }}"
                                            alt="Avatar" class="avatar">

                                        <div class="comment-meta">
                                            <span class="author">{{ optional($chilComment->user)->full_name
                                                }}</span>
                                            <span class="date">{{ $chilComment->created_at }}</span>
                                            <span class="edit-reply" data-id="{{ $chilComment->id }}">{{
                                                trans('me.edit')
                                                }}</span>
                                            <span class="delete-reply" data-id="{{ $chilComment->id }}">{{
                                                trans('me.delete')
                                                }}</span>
                                        </div><!-- .comment-meta -->

                                        <div class="comment-body">
                                            {{ $chilComment->content }}
                                        </div><!-- .comment-body -->
                                    </div>
                                    <div class="eidt-children-comment"
                                        id="eidt-children-comment-{{ $chilComment->id }}">
                                        <form action="{{ route('comment.update', ['id' => $chilComment->id,]) }}"
                                            method="post" id="commentform">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="inputComment">{{ trans('me.comment') }}</label>
                                                <textarea class="form-control" rows="6"
                                                    name="content">{{ $chilComment->content }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <button type="submit" class="btn btn-action">{{ trans('me.submit')
                                                        }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                @endforeach
                                <div id="reply-commentform-{{ $comment->id }}" class="reply-commentform">
                                    <form action="{{ route('reply.store', [
                                            'post_id' => $post->id,
                                            'parent_id' => $comment->id
                                        ]) }}" method="post" id="commentform" class="">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="inputComment">{{ trans('me.comment') }}</label>
                                            <textarea class="form-control" rows="6" name="content"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button type="submit" class="btn btn-action">{{ trans('me.submit')
                                                    }}</button>
                                            </div>

                                        </div>
                                    </form>
                                </div> <!-- /respond -->
                            </ul><!-- .children -->
                        </li>
                    </ol>
                    @endforeach

                    <div class="clearfix"></div>

                    <nav id="comment-nav-below" class="comment-navigation clearfix" role="navigation">
                        <div class="nav-content">
                            {{ $comments->links() }}
                        </div>
                    </nav>
                    @if(Auth::check())
                    <div id="respond">
                        <form action="{{ route('comment.store', ['post_id' => $post->id]) }}" method="post"
                            id="commentform" class="">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="inputComment">{{ trans('me.comment') }}</label>
                                <textarea class="form-control" rows="6" name="content" id="content"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4 text-right">
                                    <button type="submit" class="btn btn-action">{{ trans('me.submit') }}</button>
                                </div>
                        </form>
                    </div> <!-- /respond -->
                    @else
                    <p>{{ trans('me.login_to_comment') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</main>

@endsection
