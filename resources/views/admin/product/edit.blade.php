
@extends('layouts.admin')

@push('css')
    <style>
        .select2-selection__choice{background-color: #28a745 !important; color: white !important;}
        .select2-selection__choice__remove{color: #dc3545 !important;}

        label.error {
            color: #dc3545;
        }

        input.error, input.error:focus, select.error, select.error:focus{
            border: 1px solid #dc3545;
        }
    </style>
@endpush

@section('content')
        <form class="form-row" id="product-edit-form" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-3">
                <label for="ref_no">Ref No.</label>
                <input type="text" name="ref_no" value="{{ $product->ref_no }}" id="ref_no" class="form-control" placeholder="Sholud be unique" required>
            </div>
            <div class="form-group col-3">
                <label for="company">Company</label>
                <select name="company" id="company" class="form-control" required>
                    <option value="" disabled selected>Select Company</option>
                    @forelse ($companies as $company)
                        <option {{ $product->company == $company->id ? 'selected' : '' }}  value="{{ $company->id }}">{{ $company->name }}</option>
                    @empty
                        <option value="" disabled>No Companies Found</option>
                    @endforelse
                </select>
            </div>
            {{-- <div class="form-group col-3">
                <label for="model">Model</label>
                <select name="model" id="model" class="form-control" required>
                    <option value="" disabled selected>Select Model</option>
                    @forelse ($models as $model)
                        <option {{ $product->vmodel == $model->id ? 'selected' : '' }} value="{{ $model->id }}">{{ $model->name }}</option>
                    @empty
                        <option value="" disabled>No Models Found</option>
                    @endforelse
                </select>
            </div> --}}
            <div class="form-group col-3">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="" disabled selected>Select Type</option>
                    @forelse ($types as $type)
                        <option {{ $product->type == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                    @empty
                        <option value="" disabled>No Types Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="steering">Steering</label>
                <select name="steering" id="steering" class="form-control" required>
                    <option value="" disabled selected>Select Steering</option>
                    <option {{ $product->steering == 'Right' ? 'selected' : '' }} value="Right">Right</option>
                    <option {{ $product->steering == 'Left' ? 'selected' : '' }} value="Left">Left</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="transmission">Transmission</label>
                <select name="transmission" id="transmission" class="form-control" required>
                    <option value="" disabled selected>Select Transmission</option>
                    <option {{ $product->transmission == 'Manual' ? 'selected' : '' }} value="Manual">Manual</option>
                    <option {{ $product->transmission == 'CVT' ? 'selected' : '' }} value="CVT">CVT</option>
                    <option {{ $product->transmission == 'Automatic' ? 'selected' : '' }} value="Automatic">Automatic</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="fuel_type">Fuel</label>
                <select name="fuel_type" id="fuel_type" class="form-control" required>
                    <option value="" disabled selected>Select Fuel</option>
                    <option {{ $product->fuel_type == 'Petrol' ? 'selected' : '' }} value="Petrol">Petrol</option>
                    <option {{ $product->fuel_type == 'Hybrid(Petrol)' ? 'selected' : '' }} value="Hybrid(Petrol)">Hybrid(Petrol)</option>
                    <option {{ $product->fuel_type == 'Diesel' ? 'selected' : '' }} value="Diesel">Diesel</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="drive_type">Drive Type</label>
                <select name="drive_type" id="drive_type" class="form-control" required>
                    <option value="" disabled selected>Select Drive Type</option>
                    <option {{ $product->drive_type == '2WD' ? 'selected' : '' }} value="2WD">2WD</option>
                    <option {{ $product->drive_type == '4WD' ? 'selected' : '' }} value="4WD">4WD</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="color">Color</label>
                <select name="color" id="color" class="form-control" required>
                    <option value="" disabled selected>Select Color</option>
                    @forelse ($colors as $color)
                        <option {{ $product->color == $color->id ? 'selected' : '' }} value="{{ $color->id }}">{{ $color->name }}</option>
                    @empty
                        <option value="" disabled>No Colors Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="country">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="" disabled selected>Select Country</option>
                    @forelse ($countries as $country)
                        <option {{ $product->country == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                        <option value="" disabled>No Countries Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="mileage">Mileage(KM)</label>
                <input type="number" name="mileage" value="{{ $product->mileage }}" id="mileage" placeholder="8000" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="engine_cc">Engine CC</label>
                <input type="number" name="engine_cc" value="{{ $product->engine_cc }}" id="engine_cc" placeholder="1500" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="chassis_no">Chassis No</label>
                <input type="text" name="chassis_no" value="{{ $product->chassis_no }}" id="chassis_no" placeholder="MXDN000000" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="grade">Grade</label>
                <input type="text" name="grade" value="{{ $product->grade }}" id="grade" placeholder="A" class="form-control">
            </div>
            <div class="form-group col-3">
                <label for="no_of_doors">No. Of Doors</label>
                <input type="number" name="no_of_doors" value="{{ $product->no_of_doors }}" id="no_of_doors" placeholder="4" class="form-control" >
            </div>
            <div class="form-group col-3">
                <label for="seats">Seats</label>
                <input type="number" name="seats" value="{{ $product->seats }}" id="seats" placeholder="5" class="form-control" >
            </div>
            <div class="form-group col-3">
                <label for="size">Size (cm)</label>
                @php
                    $sizes = $product->size;
                    $splited = explode(',', $sizes);
                @endphp
                <div class="row">
                    <div class="col-4">
                        <input type="text" value="{{ $splited[0] ?? '' }}" name="plength" id="plength" placeholder="Length" class="form-control" title="Length">
                    </div>
                    <div class="col-4">
                        <input type="text" value="{{ $splited[1] ?? '' }}" name="pwidth" id="pwidth" placeholder="Width" class="form-control" title="Width">
                    </div>
                    <div class="col-4">
                        <input type="text" value="{{ $splited[2] ?? '' }}" name="pheight" id="pheight" placeholder="Height" class="form-control" title="Height">
                    </div>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="price">Price</label>
                <input type="number" name="price" value="{{ $product->price }}" id="price" placeholder="12000" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="discount">Discount</label>
                <input type="number" name="discount" value="{{ $product->discount }}" id="discount" placeholder="10" class="form-control">
            </div>
            <div class="form-group col-3">
                <label for="manufacture_date">Registration Year</label>
                <input type="number" name="manufacture_date" value="{{ $product->manufacture_date }}" id="manufacture_date" placeholder="2016" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="accessories">Accessories</label>
                    @php
                        $acs = explode(',', $product->accessories);
                    @endphp
                <select name="accessories[]" id="accessories" class="form-control select2" multiple>
                    @foreach ($accessories as $accessory)
                            <option {{ in_array($accessory->id, $acs) ? 'selected' : ''}} value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="deal">Deal</label>
                <select name="deal" id="deal" class="form-control">
                    <option value="" selected disabled>Select Deal</option>
                    @forelse ($deals as $deal)
                        <option {{ $product->deal == $deal->id ? 'selected' : '' }} value="{{ $deal->id }}">{{ $deal->title }}</option>
                    @empty
                        <option value="" disabled>No Deals Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-6">
                <label for="featured">Is Featured</label>
                <select name="featured" id="featured" class="form-control" required>
                    <option {{ $product->is_featured == 0 ? 'selected' : '' }} value="0">No</option>
                    <option {{ $product->is_featured == 1 ? 'selected' : '' }} value="1">Yes</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="video">Video Link</label>
                <input type="text" name="video" value="{{ $product->vedio }}" id="video" class="form-control" placeholder="Video Link">
            </div>
            <div class="form-group col-4">
                <label for="price">SEO Title</label>
                <input type="text" name="seo_title" value="{{ $product->meta_title }}" id="seo_title" placeholder="SEO Title Here" class="form-control" >
            </div>
            <div class="form-group col-4">
                <label for="price">Meta Description</label>
                <input type="text" name="meta_description" value="{{ $product->meta_description }}" id="meta_description" placeholder="Meta Description Here" class="form-control">
            </div>
            <div class="form-group col-4">
                <label for="price">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ $product->meta_keywords }}"  id="meta-keywords" placeholder="Meta Keywords Seperated By ," class="form-control" >
            </div>
            <div class="form-group col-6">
                <label for="thumbnail">Main Image</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                {{-- <img src="{{ Storage::url($product->main_image_name) }}" width="150" height="100" class="mt-2" alt="product_thumb"> --}}
                <img src="{{asset($product->main_image_name) }}" width="150" height="100" class="mt-2" alt="product_thumb">
            </div>
            <div class="form-group col-6">
                <label for="gallary">Other Images</label>
                <a href="{{ route('gallery.show', $product->id) }}">Gallary Settings</a>
                <input type="file" multiple name="gallary[]" id="gallary" class="form-control-file">
                <div class="row mt-2">
                    @forelse ($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{ asset($photo->name) }}" alt="img" width="150" height="100">
                            <a onclick="return confirm('Delete this Photo?')" href="{{ route('gallary.destroy', $photo->id) }}" class="btn btn-xs btn-danger">Delete</a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No Images Found</p>
                        </div>
                    @endforelse
                    @if($product->photos->count() > 0)
                        <div class="col-12 mt-2">
                            <a onclick="return confirm('Delete All Photos?')" href="{{ route('gallary.destroyAll', $product->id) }}" class="btn btn-danger btn-xs float-right">Delete All Images</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success btn-block">
            </div>
        </form>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select Accessories',
            closeOnSelect: false
        });

        $("#product-edit-form").validate();
    });
</script>
@endpush
