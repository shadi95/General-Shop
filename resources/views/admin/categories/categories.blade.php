@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">Categories</div>

                    <div class="card-body">

                        <!-- Category Search -->
                        <form action=" {{ route('search-categories') }}" method="get">
                                @csrf
                            <div class="row">

                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="category_search" name="category_search" placeholder="Search category" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-primary">SEASRCH</button>
                                </div>
                                    
                            </div>

                        </form>

                        <!-- Add New Category Form -->
                        <form action=" {{ route('categories') }} " method="post" class="row">
                            @csrf

                            <div class="form-group col-md-6">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" required>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">Save New Category</button>
                            </div>

                        </form>

                        <div class="row">
                            <!-- View Category  -->
                            @foreach( $categories as $category)
                            <div class="col-md-3">
                                <div class="alert alert-primary" role="alert">
                                    <span class="buttons-span">
                                        <span>
                                            <!-- Edit Category -->
                                            <a class="edit-category" data-categoryid="{{ $category->id }}" data-categoryname="{{$category->name}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </span>
                                        <span>
                                            <!-- Delete Category -->
                                            <a class="delete-category" data-categoryid="{{ $category->id }}" data-categoryname="{{$category->name}}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </span>
                                    </span>
                                    <p>{{ $category->name }}</p>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        {{ ( !is_null($showLinks) && $showLinks ) ? $categories->links() : ''}}

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
    <form action=" {{ route('categories') }} " method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    @csrf

                    <div class="form-group col-md-6">
                        <label for="edit_category_name">Category Name</label>
                        <input type="text" class="form-control" id="edit_category_name" name="category_name" placeholder="Category Name" required>
                    </div>

                    <input type="hidden" name="category_id" id="edit_category_id">
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

            <form action="{{route('categories')}}" method="post" style="position: relative;">

                <div class="modal-body">
                    <p class="delete-message"></p>
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="category_id" value="" id="category_id" />
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
<!-------------------------------------- Toast Message On Category Action ------------------------------------->
@if(session()->has('message'))

<div class="toast" style="position: absolute; z-index: 99999; top:5%; right:5%">

    <div class="toast-header">
        <strong class="mr-auto">Category</strong>
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
            var $deleteCategory = $('.delete-category');
            var $deleteWindow = $('#delete-window');
            var $categoryID = $('#category_id');
            var $deleteMessage = $('.delete-message')

            $deleteCategory.on('click', function(element) {
                element.preventDefault();
                var category_id = $(this).data('categoryid');
                $categoryID.val(category_id);

                $deleteMessage.text('Are You Sure You Want To Delete the category ?');
                $deleteWindow.modal('show');
            });
            // EDIT MODAL 
            var $editCategory = $('.edit-category');
            var $editWindow = $('#edit-window');

            var $edit_category_name = $('#edit_category_name');
            var $edit_category_id = $('#edit_category_id');


            $editCategory.on('click', function(element) {
                element.preventDefault();
                var categoryName = $(this).data('categoryname');
                var category_id = $(this).data('categoryid');

                $edit_category_id.val(category_id);
                $edit_category_name.val(categoryName);

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