@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('parts.update', $autopart->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-3">
                <label for="ref_no">Ref No.</label>
                <input type="text" name="ref_no" value="{{ $autopart->ref_no }}" id="ref_no" class="form-control" placeholder="Should be unique" required>
            </div>
            <div class="form-group col-3">
                <label for="company">Company</label>
                <select name="company" id="company" class="form-control" required>
                    <option value="" disabled selected>Select Company/Maker</option>
                    @forelse ($companies as $company)
                        <option {{ $autopart->company == $company->id ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                    @empty
                        <option value="" disabled>No Companies Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="model">Model</label>
                <select name="model" id="model" class="form-control" required>
                    <option value="" disabled selected>Select Model</option>
                    @forelse ($models as $model)
                        <option {{ $autopart->vmodel == $model->id ? 'selected' : '' }} value="{{ $model->id }}">{{ $model->name }}</option>
                    @empty
                        <option value="" disabled>No Models Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="country">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="" disabled selected>Select Country</option>
                    @forelse ($countries as $country)
                        <option {{ $autopart->country == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                    @empty
                        <option value="" disabled>No Country Found</option>
                    @endforelse
                </select>
            </div>
            @php
                $years = ['2000','2001','2002','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020','2021']
            @endphp
            <div class="form-group col-3">
                <label for="from_year">From Year</label>
                <select name="from_year" id="from_year" class="form-control" required>
                    <option value="" disabled selected>From Year</option>
                    @forelse ($years as $year)
                        <option {{ $autopart->from_year == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                    @empty
                        <option value="" disabled>No Years Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="to_year">To Year</label>
                <select name="to_year" id="to_year" class="form-control" required>
                    <option value="" disabled selected>To Year</option>
                    @forelse ($years as $year)
                        <option {{ $autopart->to_year == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                    @empty
                        <option value="" disabled>No Years Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="registration_date">Registration Date</label>
                <select name="registration_date" id="registration_date" class="form-control" required>
                    <option value="" disabled selected>Select Registration Date</option>
                    @forelse ($years as $year)
                        <option {{ $autopart->registration_date == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                    @empty
                        <option value="" disabled>No Years Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="condition">Condition</label>
                <select name="condition" id="condition" class="form-control" required>
                    <option value="" disabled selected>Select Condition</option>
                    <option {{ $autopart->condition == 'New' ? 'selected' : '' }} value="New">New</option>
                    <option {{ $autopart->condition == 'Used' ? 'selected' : '' }} value="Used">Used</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" value="{{ $autopart->product_name }}" id="product_name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="form-group col-3">
                <label for="fuel">Fuel</label>
                <select name="fuel" id="fuel" class="form-control">
                    <option value="" disabled selected>Select Fuel</option>
                    <option {{ $autopart->fuel == 'Petrol' ? 'selected' : '' }} value="Petrol">Petrol</option>
                    <option {{ $autopart->fuel == 'Diesel' ? 'selected' : '' }} value="Diesel">Diesel</option>
                    <option {{ $autopart->fuel == 'Hybrid(Petrol)' ? 'selected' : '' }} value="Hybrid(Petrol)">Hybrid(Petrol)</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="drive_type">Drive Type</label>
                <select name="drive_type" id="drive_type" class="form-control">
                    <option value="" disabled selected>Select Drive Type</option>
                    <option {{ $autopart->drive == '2WD' ? 'selected' : '' }} value="2WD">2WD</option>
                    <option {{ $autopart->drive == '4WD' ? 'selected' : '' }} value="4WD">4WD</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="mission_type">Mission Type</label>
                <select name="mission_type" id="mission_type" class="form-control">
                    <option value="" disabled selected>Select Mission Type</option>
                    <option {{ $autopart->mission_type == 'Manual' ? 'selected' : '' }} value="Manual">Manual</option>
                    <option {{ $autopart->mission_type == 'CVT' ? 'selected' : '' }} value="CVT">CVT</option>
                    <option {{ $autopart->mission_type == 'Automatic' ? 'selected' : '' }} value="Automatic">Automatic</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="model_code">Model Code</label>
                <input type="text" name="model_code" value="{{ $autopart->model_code }}" id="model_code" class="form-control" placeholder="Model Code" required>
            </div>
            <div class="form-group col-3">
                <label for="mileage">Mileage</label>
                <input type="number" name="mileage" value="{{ $autopart->mileage }}" id="mileage" class="form-control" placeholder="Mileage">
            </div>
            <div class="form-group col-3">
                <label for="engine_model">Engine Model</label>
                <input type="text" name="engine_model" value="{{ $autopart->engine_model }}" id="engine_model" class="form-control" placeholder="Engine Model">
            </div>
            <div class="form-group col-3">
                <label for="engine_size">Engine Size</label>
                <input type="number" name="engine_size" value="{{ $autopart->engine_size }}" id="engine_size" class="form-control" placeholder="Engine Size">
            </div>
            <div class="form-group col-3">
                <label for="auto_parts_maker">Autoparts Maker</label>
                <input type="text" name="auto_parts_maker" value="{{ $autopart->auto_parts_maker }}" id="auto_parts_maker" class="form-control" placeholder="Autoparts Maker" required>
            </div>
            <div class="form-group col-3">
                <label for="genuine_parts_no">Genuine Parts No.</label>
                <input type="text" name="genuine_parts_no" value="{{ $autopart->genuine_parts_no }}" id="genuine_parts_no" class="form-control" placeholder="Genuine Parts No.">
            </div>
            <div class="form-group col-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="{{ $autopart->price }}" class="form-control" placeholder="Price" required>
            </div>
            <div class="form-group col-12">
                <label for="description">Description</label>
                <textarea type="number" name="description" id="description" class="form-control" rows="5" placeholder="Description">{{ $autopart->description }}</textarea>
            </div>
            <div class="form-group col-6">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                <div class="mt-2" id="thumb">
                    <img src="{{ Storage::url($autopart->main_image_name) }}" width="150" height="100">
                </div>
            </div>
            <div class="form-group col-6">
                <label for="gallary">Gallary</label>
                <input type="file" name="gallary[]" id="gallary" class="form-control-file" multiple>
                <div class="mt-2 row" id="gallary">
                    @forelse ($autopart->photos as $photo)
                        <div class="col-4 mb-2">
                            <img src="{{ Storage::url($photo->name) }}" width="150" height="100">
                        </div>
                    @empty
                    <div class="col-12">
                        <p>No Images Found</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Update" class="btn btn-sm btn-success btn-block">
            </div>
        </form>
@endsection
