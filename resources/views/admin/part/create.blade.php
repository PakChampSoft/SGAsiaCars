@extends('layouts.admin')

@section('content')
        <form class="form-row" method="POST" action="{{ route('parts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-3">
                <label for="ref_no">Ref No.</label>
                <input type="text" name="ref_no" id="ref_no" class="form-control" placeholder="Should be unique" required>
            </div>
            <div class="form-group col-3">
                <label for="company">Company</label>
                <select name="company" id="company" class="form-control" required>
                    <option value="" disabled selected>Select Company/Maker</option>
                    @forelse ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
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
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
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
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                        <option value="{{ $year }}">{{ $year }}</option>
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
                        <option value="{{ $year }}">{{ $year }}</option>
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
                        <option value="{{ $year }}">{{ $year }}</option>
                    @empty
                        <option value="" disabled>No Years Found</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group col-3">
                <label for="condition">Condition</label>
                <select name="condition" id="condition" class="form-control" required>
                    <option value="" disabled selected>Select Condition</option>
                    <option value="New">New</option>
                    <option value="Used">Used</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" required>
            </div>
            <div class="form-group col-3">
                <label for="fuel">Fuel</label>
                <select name="fuel" id="fuel" class="form-control">
                    <option value="" disabled selected>Select Fuel</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Hybrid(Petrol)">Hybrid(Petrol)</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="drive_type">Drive Type</label>
                <select name="drive_type" id="drive_type" class="form-control">
                    <option value="" disabled selected>Select Drive Type</option>
                    <option value="2WD">2WD</option>
                    <option value="4WD">4WD</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="mission_type">Mission Type</label>
                <select name="mission_type" id="mission_type" class="form-control">
                    <option value="" disabled selected>Select Mission Type</option>
                    <option value="Manual">Manual</option>
                    <option value="CVT">CVT</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="model_code">Model Code</label>
                <input type="text" name="model_code" id="model_code" class="form-control" placeholder="Model Code" required>
            </div>
            <div class="form-group col-3">
                <label for="mileage">Mileage</label>
                <input type="number" name="mileage" id="mileage" class="form-control" placeholder="Mileage">
            </div>
            <div class="form-group col-3">
                <label for="engine_model">Engine Model</label>
                <input type="text" name="engine_model" id="engine_model" class="form-control" placeholder="Engine Model">
            </div>
            <div class="form-group col-3">
                <label for="engine_size">Engine Size</label>
                <input type="number" name="engine_size" id="engine_size" class="form-control" placeholder="Engine Size">
            </div>
            <div class="form-group col-3">
                <label for="auto_parts_maker">Autoparts Maker</label>
                <input type="text" name="auto_parts_maker" id="auto_parts_maker" class="form-control" placeholder="Autoparts Maker" required>
            </div>
            <div class="form-group col-3">
                <label for="genuine_parts_no">Genuine Parts No.</label>
                <input type="text" name="genuine_parts_no" id="genuine_parts_no" class="form-control" placeholder="Genuine Parts No.">
            </div>
            <div class="form-group col-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Price" required>
            </div>
            <div class="form-group col-12">
                <label for="description">Description</label>
                <textarea type="number" name="description" id="description" class="form-control" rows="5" placeholder="Description"></textarea>
            </div>
            <div class="form-group col-6">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" required>
                <div class="mt-2" id="thumb"></div>
            </div>
            <div class="form-group col-6">
                <label for="gallary">Gallary</label>
                <input type="file" name="gallary[]" id="gallary" class="form-control-file" multiple>
                <div class="mt-2" id="gallary"></div>
            </div>
            <div class="form-group col-12">
                <input type="submit" value="Add" class="btn btn-sm btn-success btn-block">
            </div>
        </form>
@endsection
