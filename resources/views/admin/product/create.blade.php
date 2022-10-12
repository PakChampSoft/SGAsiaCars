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
        <form class="form-row" id="product-create-form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-3">
                <label for="ref_no">Ref No.</label>
                <input type="text" value="{{ strtoupper(substr(str_shuffle(MD5(microtime())), 0, 6)) }}" name="ref_no" id="ref_no" class="form-control" placeholder="Sholud be unique" required>
            </div>
            <div class="form-group col-3">
                <label for="company">Company</label>
                <select name="company" id="company" class="form-control" required>
                    <option value="" disabled selected>Select Company</option>
                    @forelse ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
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
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
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
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @empty
                        <option value="" disabled>No Types Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="steering">Steering</label>
                <select name="steering" id="steering" class="form-control" required>
                    <option value="" disabled selected>Select Steering</option>
                    <option value="Right">Right</option>
                    <option value="Left">Left</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="transmission">Transmission</label>
                <select name="transmission" id="transmission" class="form-control" required>
                    <option value="" disabled selected>Select Transmission</option>
                    <option value="Manual">Manual</option>
                    <option value="CVT">CVT</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="fuel_type">Fuel</label>
                <select name="fuel_type" id="fuel_type" class="form-control" required>
                    <option value="" disabled selected>Select Fuel</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Hybrid(Petrol)">Hybrid(Petrol)</option>
                    <option value="Diesel">Diesel</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="drive_type">Drive Type</label>
                <select name="drive_type" id="drive_type" class="form-control" required>
                    <option value="" disabled selected>Select Drive Type</option>
                    <option value="2WD">2WD</option>
                    <option value="4WD">4WD</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="color">Color</label>
                <select name="color" id="color" class="form-control" required>
                    <option value="" disabled selected>Select Color</option>
                    @forelse ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
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
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                        <option value="" disabled>No Countries Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="mileage">Mileage(KM)</label>
                <input type="number" name="mileage" id="mileage" placeholder="8000" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="engine_cc">Engine CC</label>
                <input type="number" name="engine_cc" id="engine_cc" placeholder="1500" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="chassis_no">Chassis No</label>
                <input type="text" name="chassis_no" id="chassis_no" placeholder="MXDN000000" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="grade">Grade</label>
                <input type="text" name="grade" id="grade" placeholder="A" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="no_of_doors">No. Of Doors</label>
                <input type="number" name="no_of_doors" id="no_of_doors" placeholder="4" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="seats">Seats</label>
                <input type="number" name="seats" id="seats" placeholder="5" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="size">Size (cm)</label>
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="plength" id="plength" placeholder="Length" class="form-control" title="Length">
                    </div>
                    <div class="col-4">
                        <input type="text" name="pwidth" id="pwidth" placeholder="Width" class="form-control" title="Width">
                    </div>
                    <div class="col-4">
                        <input type="text" name="pheight" id="pheight" placeholder="Height" class="form-control" title="Height">
                    </div>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" placeholder="12000" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label for="discount">Discount</label>
                <input type="number" name="discount" id="discount" placeholder="10" class="form-control">
            </div>
            <div class="form-group col-3">
                <label for="manufacture_date">Registration Year</label>
                <input type="number" name="manufacture_date" id="manufacture_date" placeholder="2016" class="form-control" required>
            </div>
            <div class="form-group col-6">
                <label for="accessories">Accessories</label>
                <select name="accessories[]" id="accessories" class="form-control select2" multiple required>
                    @foreach ($accessories as $accessory)
                        <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="deal">Deal</label>
                <select name="deal" id="deal" class="form-control">
                    <option value="" selected disabled>Select Deal</option>
                    @forelse ($deals as $deal)
                        <option value="{{ $deal->id }}">{{ $deal->title }}</option>
                    @empty
                        <option value="" disabled>No Deals Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-6">
                <label for="featured">Is Featured</label>
                <select name="featured" id="featured" class="form-control" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="video">Video Link</label>
                <input type="text" name="video" id="video" class="form-control" placeholder="Video Link">
            </div>
            <div class="form-group col-4">
                <label for="price">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" placeholder="SEO Title Here" class="form-control" >
            </div>
            <div class="form-group col-4">
                <label for="price">Meta Description</label>
                <input type="text" name="meta_description" id="meta_description" placeholder="Meta Description Here" class="form-control" >
            </div>
            <div class="form-group col-4">
                <label for="price">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" placeholder="Meta Keywords Seperated By ," class="form-control" >
            </div>
            <div class="form-group col-6">
                <label for="thumbnail">Main Image</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" required>
                <div id="thumb" class="mt-2"></div>
            </div>
            <div class="form-group col-6">
                <label for="gallary">Other Images</label>
                <input type="file" multiple name="gallary[]" id="gallary" class="form-control-file">
                <div class="mt-2">
                    <div class="row" id="gallayImages"></div>
                </div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success btn-block">
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

        $("#product-create-form").validate();

        $("#thumbnail").change(function(e){
            var thumbDiv = document.getElementById('thumb');
            var files = e.target.files;
            if(files.length > 0){
                console.log(files);
                var img = document.createElement('img');
                img.width = "150";
                img.height = "100";
                var reader = new FileReader();
                reader.onloadend = function(){
                    img.src = reader.result;
                }

                reader.readAsDataURL(files[0])
                $("#thumb").empty();
                thumbDiv.append(img);
            }else{
                $("#thumb").empty();
            }
        });

        $("#gallary").change(function(e){
            var gallayImagesDiv = document.getElementById('gallayImages');
            var files = e.target.files;
            if(files.length > 0){
                console.log(files);
                $("#gallayImages").empty();
                for(let i = 0; i < files.length; i++){
                    let reader = new FileReader();
                    let colDiv = document.createElement('div');
                    colDiv.classList.add('col-4');
                    colDiv.classList.add('mb-2');

                    let img = document.createElement('img');
                    img.width = "150";
                    img.height = "100";

                    reader.onload = function(){
                        img.src = reader.result;
                    }
                    reader.onerror = function(){
                        console.log(reader.error);
                    }
                    reader.readAsDataURL(files[i])

                    colDiv.append(img);
                    gallayImagesDiv.append(colDiv);
                }
            }else{
                $("#gallayImages").empty();
            }
        });
    });
</script>
@endpush
