@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\BlogPost $item */@endphp


    <div class="container">
        @include('blog.admin.posts.includes.result_messages')
        @if($item->exists)
            <form action="{{ route('blog.admin.posts.update', $item->id) }}" method="POST">
                @method('PATCH')
        @else
            <form action="{{ route('blog.admin.posts.store') }}" method="POST">
        @endif
                 @csrf
                 <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('blog.admin.posts.includes.post_edit_main_col')
                            </div>
                            <div class="col-md-4">
                                @include('blog.admin.posts.includes.post_edit_add_col')
                            </div>
                 </div>
            </form>
            @if($item->exists)
                        <form action="{{ route('blog.admin.posts.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="row justify-content-center">
                                 <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body ml-auto">
                                            <button type="submit" class="btn btn-link">Удалить</button>
                                        </div>

                                    </div>
                                 </div>
                                <div class="col-md-4"></div>
                            </div>

                        </form>
            @endif
    </div>

@endsection