@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="{{ asset('lightbox/css/lightbox.min.css') }}">
@endpush

@section('content')

<div class="card">
    <h4 class="card-header">Public Images (drag to sort or to make private)</h4>
    <div class="card-body">
        <div class="row connectedSortable" id="available">
            @forelse ($gallary->where('is_private', 0)->sortBy('sorting_order') as $image)
                <div class="col-1" gid="{{ $image->id }}">
                    <div class="card available">
                        <a href="{{ asset($image->name) }}" data-lightbox="ordered_images">
                            <img src="{{ asset($image->name) }}" class="card-img-top" alt="gallery image">
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

<div class="card">
    <h4 class="card-header">Private Images</h4>
    <div class="card-body">
        <div class="row connectedSortable" id="private">
            @forelse ($gallary->where('is_private', 1)->sortBy('sorting_order') as $image)
                <div class="col-1" gid="{{ $image->id }}">
                    <div class="card">
                        <a href="{{ asset($image->name) }}" data-lightbox="private_images">
                            <img src="{{ asset($image->name) }}" class="card-img-top" alt="gallery image">
                        </a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

<div class="card">
    <h4 class="card-header">Trash Images <span class="text-danger">(Images will be deleted forever)</span></h4>
    <div class="card-body">
        <div class="row connectedSortable" id="trash">
        </div>
    </div>
</div>

<form class="row" action="{{ route('gallery.bulkupdate') }}">
    <div class="col-12">
        <button class="btn btn-block btn-warning" id="update_btn">Update</button>
    </div>
</form>

@endsection

@push('js')
<script src="{{ asset('lightbox/js/lightbox.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // $( ".available" ).draggable();
        var sortOrder = [];
        var isPrivate = [];
        var trashed = [];

        $( "#available, #private, #trash" ).sortable({
            connectWith: ".connectedSortable",
        });

        $("#available").sortable({
            stop: function(e, ui) {
                sortOrder = [];
                $.map($(this).find('div.col-1'), function(el) {
                    sortOrder.push(el.getAttribute('gid'));
                })
                // console.log(sortOrder);
                // console.log($.map($(this).find('div.col-1'), function(el) {
                //     return el.getAttribute('gid') + ' = ' + $(el).index();
                // }));
            },
            update: function(e, ui) {
                sortOrder = [];
                $.map($(this).find('div.col-1'), function(el) {
                    sortOrder.push(el.getAttribute('gid'));
                })
                // console.log(sortOrder);
            }
        });

        $("#private").sortable({
            stop: function(e, ui) {
                isPrivate = [];
                $.map($(this).find('div.col-1'), function(el) {
                    isPrivate.push(el.getAttribute('gid'));
                })
                // console.log(isPrivate);
            },
            update: function(e, ui) {
                isPrivate = [];
                $.map($(this).find('div.col-1'), function(el) {
                    isPrivate.push(el.getAttribute('gid'));
                })
                // console.log(isPrivate);
            }
        });

        $("#trash").sortable({
            stop: function(e, ui) {
                trashed = [];
                $.map($(this).find('div.col-1'), function(el) {
                    trashed.push(el.getAttribute('gid'));
                })
                // console.log(isPrivate);
            },
            update: function(e, ui) {
                trashed = [];
                $.map($(this).find('div.col-1'), function(el) {
                    trashed.push(el.getAttribute('gid'));
                })
                console.log(trashed);
            }
        });

        $("#available, #private, #trash").disableSelection();

        $("#update_btn").click(function(){
            var form = this.form;
            var sortInput = document.createElement('input');
            var privateInput = document.createElement('input');
            var trashedInput = document.createElement('input');
            sortInput.type = 'hidden';
            sortInput.name = 'ordered';
            sortInput.value = sortOrder;
            form.append(sortInput);

            privateInput.type = 'hidden';
            privateInput.name = 'privated';
            privateInput.value = isPrivate;
            form.append(privateInput);

            trashedInput.type = 'hidden';
            trashedInput.name = 'trashed';
            trashedInput.value = trashed;
            form.append(trashedInput);

            this.form.submit();
        })

    });
</script>

@endpush
