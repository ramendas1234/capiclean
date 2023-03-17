@extends('layout.app')


@section('title', 'posts')
@section('content')

<div class="row">
    <div class="col-md-8">
        <h2>All Posts</h2>


        @forelse ($posts as $post)
            <div class="mb-3">

                <h3>
                    @if ($post->trashed())
                        <del>
                    @endif
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post['title'] }}</a>
                    @if ($post->trashed())
                        </del>
                    @endif
                </h3>
                
                {{-- <p class="text-muted">
                    Added {{ $post->created_at->diffForHumans() }}
                    by <strong> {{ $post->user->name }} </strong>
                </p> --}}

                <x-updated date="{{ $post->created_at->diffForHumans() }}" name="{{ $post->user->name }}" userId="{{ $post->user->id }}" >
                    added by
                </x-updated> 

                <p>{{ $post['content'] }}</p>

                <?php
                //echo var_dump($post->tags); exit();
                //dd($post->tags);
                $test_array = ['Rohit', 'Shamm', 'Dinu'];
                ?>
                <x-tag :tags="$post->tags"  />

                @if ($post->comments_count)
                <p>{{ $post->comments_count }} comments</p>
                @else
                <p>0 comments</p>
                @endif
                
            @auth
                    @can('update', $post)
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>    
                    @endcan
                    
                    @can('delete', $post)
                        <form method="POST" class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete!" class="btn btn-primary"/>
                        </form>
                    @endcan

                    @can('restore', $post)
                        <form method="POST" class="d-inline" action=" {{ route('posts.restore', ['id' => $post->id ]) }} ">
                            @csrf
                            <input type="submit" value="Restore" class="btn btn-primary"/>
                        </form>
                    @endcan
            @endauth    
                
                
                
            </div>
        @empty
        <p class="alert alert-danger">Sorry no posts found.</p>
        @endforelse

    </div>
    <div class="col-md-4">
        @include('posts.partials.__sidebar');
    </div>

</div>



@endsection