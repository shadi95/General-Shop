@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Units</div>

                        <div class="card-body">
                            <!-- Units Search -->
                            <form action=" {{ route('search-units') }}" method="get">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-md-8">
                                        <input type="text" class="form-control" id="unit_search" name="unit_search" placeholder="Search Unit" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary">SEASRCH</button>
                                    </div>
                                
                                </div>

                            </form>
                            <!-- Add New Unit Form -->
                            <form action=" {{ route('units') }} " method="post" class="row">
                                @csrf

                                <div class="form-group col-md-6">
                                    <label for="unit_name">Unit Name</label>
                                    <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="unit_code">Unit code</label>
                                    <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit code" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">Save New Unit</button>
                                </div>

                            </form>
                            <!-- Units View -->
                            <div class="row">

                                @foreach( $units as $unit)
                                    <div class="col-md-3">
                                        <div class="alert alert-primary" role="alert">
                                            <span class="buttons-span">
                                                <span>
                                                    <!-- Edit Unit -->
                                                    <a class="edit-unit" data-unitid="{{ $unit->id }}" data-unitname="{{$unit->unit_name}}" data-unitcode="{{ $unit->unit_code }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </span>
                                                <span>
                                                    <!-- Delete Unit -->
                                                    <a class="delete-unit" data-unitid="{{ $unit->id }}" data-unitname="{{$unit->unit_name}}" data-unitcode="{{ $unit->unit_code }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </span>
                                            </span>
                                            <p>{{ $unit->unit_name }}, {{ $unit->unit_code }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            {{ ( !is_null($showLinks) && $showLinks ) ? $units->links() : ''}}

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
    <form action=" {{ route('units') }} " method="post">
        <div class="modal-dialog" role="document">            
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    @csrf

                    <div class="form-group col-md-6">
                        <label for="edit_unit_name">Unit Name</label>
                        <input type="text" class="form-control" id="edit_unit_name" name="unit_name" placeholder="Unit Name" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="edit_unit_code">Unit code</label>
                        <input type="text" class="form-control" id="edit_unit_code" name="unit_code" placeholder="Unit code" required>
                    </div>

                    <input type="hidden" name="unit_id" id="edit_unit_id">
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

            <form action="{{route('units')}}" method="post" style="position: relative;">

                <div class="modal-body">
                    <p class="delete-message"></p>
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <input type="hidden" name="delete_unit_id" value="" id="delete_unit_id" />
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
<!-------------------------------------- Toast Message On Units Action ------------------------------------->
@if(session()->has('message'))

    <div class="toast" style="position: absolute; z-index: 99999; top:5%; right:5%">

        <div class="toast-header">
            <strong class="mr-auto">Units</strong>
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
            var $deleteUnit = $('.delete-unit');
            var $deleteWindow = $('#delete-window');
            var $unitId = $('#delete_unit_id');
            var $deleteMessage = $('.delete-message')

            $deleteUnit.on('click', function(element) {
                element.preventDefault();
                var unit_id = $(this).data('unitid');
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');
                $unitId.val(unit_id);

                $deleteMessage.text('Are You Sure You Want To Delete ' + unitName + ' With Code ' + unitCode + '?');
                $deleteWindow.modal('show');
            });
            // EDIT MODAL 
            var $editUnit = $('.edit-unit');
            var $editWindow = $('#edit-window');

            var $edit_unit_name = $('#edit_unit_name');
            var $edit_unit_code = $('#edit_unit_code');
            var $edit_unit_id = $('#edit_unit_id');


            $editUnit.on('click', function(element) {
                element.preventDefault();
                var unitName = $(this).data('unitname');
                var unitCode = $(this).data('unitcode');
                var unit_id = $(this).data('unitid');

                $edit_unit_code.val(unitCode);
                $edit_unit_id.val(unit_id);
                $edit_unit_name.val(unitName);

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