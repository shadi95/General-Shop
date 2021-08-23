@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">Tags</div>

                    <div class="card-body">

                        <!-- Tags Search -->
                        <form action=" {{ route('search-tags') }}" method="get">
                                @csrf
                            <div class="row">

                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="tag_search" name="tag_search" placeholder="Search Tags" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-primary">SEASRCH</button>
                                </div>
                                    
                            </div>

                        </form>

                        <!-- Add New Tags Form -->
                        <form action=" {{ route('tags') }} " method="post" class="row">
                            @csrf

                            <div class="form-group col-md-6">
                                <label for="unit_name">Tag Name</label>
                                <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Tag Name" required>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New Tag</button>
                            </div>

                        </form>

                        <div class="row">
                            <!-- View Tags  -->
                            @foreach( $tags as $tag)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <span class="buttons-span">
                                        <span>
                                            <!-- Edit tag -->
                                            <a class="edit-tag" data-tagid="{{ $tag->id }}" data-tagname="{{$tag->tag}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </span>
                                        <span>
                                            <!-- Delete tag -->
                                            <a class="delete-tag" data-tagid="{{ $tag->id }}" data-tagname="{{$tag->tag}}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </span>
                                    </span>
                                    <p>{{ $tag->tag }}</p>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        {{ ( !is_null($showLinks) && $showLinks ) ? $tags->links() : ''}}

                    </div>                    

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

<!--//////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!----------------------------------------------- Edit Modal ----------------------------------------------->
<div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
    <form action=" {{ route('tags') }} " method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    @csrf

                    <div class="form-group col-md-6">
                        <label for="edit_tag_name">tag Name</label>
                        <input type="text" class="form-control" id="edit_tag_name" name="tag_name" placeholder="Tag Name" required>
                    </div>

                    <input type="hidden" name="tag_id" id="edit_tag_id">
                    <input type="hidden" name="_method" value="PUT" />

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CAVSEL</button>
                </div>

            </div>
        </div>
    </form>
</div>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!----------------------------------------------- Delete Modal --------------------------------------------->
<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Delete Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('tags')}}" method="post" style="position: relative;">

                <div class="modal-body">
                    <p class="delete-message"></p>
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="tag_id" value="" id="tag_id" />
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!-------------------------------------- Toast Message On Tags Action ------------------------------------->
@if(session()->has('message'))

<div class="toast" style="position: absolute; z-index: 99999; top:5%; right:5%">

    <div class="toast-header">
        <strong class="mr-auto">Tag</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="toast-body">
        <strong> {{session('message')}}</strong>
    </div>

</div>

@endif
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!----------------------------------------------  Script Section ------------------------------------------->
@section('scripts')

    <script>
        /////////////////// Unit Action Modal //////////////////////////
        $(document).ready(function() {
            // DELETE MODAL 
            var $deleteTag = $('.delete-tag');
            var $deleteWindow = $('#delete-window');
            var $tagID = $('#tag_id');
            var $deleteMessage = $('.delete-message')

            $deleteTag.on('click', function(element) {
                element.preventDefault();
                var tag_id = $(this).data('tagid');
                $tagID.val(tag_id);

                $deleteMessage.text('Are You Sure You Want To Delete the tag ?');
                $deleteWindow.modal('show');
            });
            // EDIT MODAL 
            var $editTag = $('.edit-tag');
            var $editWindow = $('#edit-window');

            var $edit_tag_name = $('#edit_tag_name');
            var $edit_tag_id = $('#edit_tag_id');


            $editTag.on('click', function(element) {
                element.preventDefault();
                var tagName = $(this).data('tagname');
                var tag_id = $(this).data('tagid');

                $edit_tag_id.val(tag_id);
                $edit_tag_name.val(tagName);

                $editWindow.modal('show');
            });
        });
    </script>

    @if(session()->has('message'))

        <script>
            //Toast Script
            jQuery(document).ready(function($) {
                var $toast = $('.toast').toast({
                    autohide: false,
                });
                $toast = $('.toast').toast('show');
            });
        </script>

    @endif

@endsection