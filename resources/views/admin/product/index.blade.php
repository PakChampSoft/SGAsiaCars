@extends('layouts.admin')

@section('content')

    <h5 class="text-center">Search Product <span id="stock_quantity"></span></h5>
    <form class="form-row" action="{{ route('products.index') }}" id="stock_filter_form">
        <div class="form-group col-6">
            <label for="ref_no">Ref No.</label>
            <input type="text" name="ref_no" value="{{ request()->ref_no }}" id="ref_no" class="form-control filter_i {{ request()->filled('ref_no') ? 'bg-info' : '' }}" placeholder="By Reference No.">
        </div>
        <div class="form-group col-6">
            <label for="chassis_no">Chassis No.</label>
            <input type="text" name="chassis_no" value="{{ request()->chassis_no }}" id="chassis_no" class="form-control filter_i {{ request()->filled('chassis_no') ? 'bg-info' : '' }}" placeholder="By Chassis No.">
        </div>
        <div class="form-group col-3">
            <label for="company">Company/Make</label>
            <select class="form-control filter_s {{ request()->filled('company') ? 'bg-info' : '' }}" name="company" id="company">
                <option value="">Any Make</option>
                @forelse ($companies as $company)
                    <option {{ request()->company == $company->id ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }} ({{ $company->products_count }})</option>
                @empty
                    <option value="" disabled>No Companies Found</option>
                @endforelse
            </select>
        </div>
        {{-- <div class="form-group col-3">
            <label for="model">Model</label>
            <select class="form-control filter_s {{ request()->filled('model') ? 'bg-info' : '' }}" name="model" id="model">
                <option value="">Any Model</option>
                @forelse ($models as $model)
                    <option {{ request()->model == $model->id ? 'selected' : '' }} value="{{ $model->id }}">{{ $model->name }} ({{ $model->products_count }})</option>
                @empty
                    <option value="" disabled>No Models Found</option>
                @endforelse
            </select>
        </div> --}}
        <div class="form-group col-3">
            <label for="type">Type</label>
            <select class="form-control filter_s {{ request()->filled('type') ? 'bg-info' : '' }}" name="type" id="type">
                <option value="">Any Type</option>
                @forelse ($types as $type)
                    <option {{ request()->type == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                @empty
                    <option value="" disabled>No Types Found</option>
                @endforelse
            </select>
        </div>
        <div class="form-group col-3">
            <label for="fuel">Fuel</label>
            <select class="form-control filter_s {{ request()->filled('fuel') ? 'bg-info' : '' }}" name="fuel" id="fuel">
                <option value="">Any Model</option>
                <option {{ request()->fuel == 'Petrol' ? 'selected' : '' }} value="Petrol">Petrol</option>
                <option {{ request()->fuel == 'Diesel' ? 'selected' : '' }} value="Diesel">Diesel</option>
            </select>
        </div>
        {{-- <div class="form-group col-3">
            <label for="drive_type">Drive Type</label>
            <select class="form-control filter_s {{ request()->filled('drive_type') ? 'bg-info' : '' }}" name="drive_type" id="drive_type">
                <option value="">Any</option>
                <option {{ request()->drive_type == '2WD' ? 'selected' : '' }} value="2WD">2WD</option>
                <option {{ request()->drive_type == '4WD' ? 'selected' : '' }} value="4WD">4WD</option>
            </select>
        </div> --}}
        <div class="form-group col-3">
            <label for="transmission">Transmission</label>
            <select class="form-control filter_s {{ request()->filled('transmission') ? 'bg-info' : '' }}" name="transmission" id="transmission">
                <option value="">Any</option>
                <option {{ request()->transmission == 'Automatic' ? 'selected' : '' }} value="Automatic">Automatic</option>
                <option {{ request()->transmission == 'CVT' ? 'selected' : '' }} value="CVT">CVT</option>
                <option {{ request()->transmission == 'Manual' ? 'selected' : '' }} value="Manual">Manual</option>
            </select>
        </div>

        <div class="form-group col-3">
            <label for="min_engine">Min Engine</label>
            <select class="form-control filter_s {{ request()->filled('min_engine') ? 'bg-info' : '' }}" name="min_engine" id="min_engine">
                <option value="">Min Engine</option>
                <option {{ request()->min_engine == '700' ? 'selected' : '' }} value="700">700CC</option>
                <option {{ request()->min_engine == '1000' ? 'selected' : '' }} value="1000">1000CC</option>
                <option {{ request()->min_engine == '1500' ? 'selected' : '' }} value="1500">1500CC</option>
                <option {{ request()->min_engine == '1800' ? 'selected' : '' }} value="1800">1800CC</option>
                <option {{ request()->min_engine == '2000' ? 'selected' : '' }} value="2000">2000CC</option>
                <option {{ request()->min_engine == '2500' ? 'selected' : '' }} value="2500">2500CC</option>
                <option {{ request()->min_engine == '3000' ? 'selected' : '' }} value="3000">3000CC</option>
                <option {{ request()->min_engine == '4000' ? 'selected' : '' }} value="4000">4000CC</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="max_engine">Max Engine</label>
            <select class="form-control filter_s {{ request()->filled('max_engine') ? 'bg-info' : '' }}" name="max_engine" id="max_engine">
                <option value="">Max Engine</option>
                <option {{ request()->max_engine == '700' ? 'selected' : '' }} value="700">700CC</option>
                <option {{ request()->max_engine == '1000' ? 'selected' : '' }} value="1000">1000CC</option>
                <option {{ request()->max_engine == '1500' ? 'selected' : '' }} value="1500">1500CC</option>
                <option {{ request()->max_engine == '1800' ? 'selected' : '' }} value="1800">1800CC</option>
                <option {{ request()->max_engine == '2000' ? 'selected' : '' }} value="2000">2000CC</option>
                <option {{ request()->max_engine == '2500' ? 'selected' : '' }} value="2500">2500CC</option>
                <option {{ request()->max_engine == '3000' ? 'selected' : '' }} value="3000">3000CC</option>
                <option {{ request()->max_engine == '4000' ? 'selected' : '' }} value="4000">4000CC</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="color">Color</label>
            <select class="form-control filter_s {{ request()->filled('color') ? 'bg-info' : '' }}" name="color" id="color">
                <option value="">Any</option>
                @forelse ($colors as $color)
                    <option {{ request()->color == $color->id ? 'selected' : '' }} value="{{ $color->id }}">{{ $color->name }}</option>
                @empty
                    <option value="" disabled>No Colors Found</option>
                @endforelse
            </select>
        </div>
        <div class="form-group col-3">
            <label for="country">Country</label>
            <select class="form-control filter_s {{ request()->filled('country') ? 'bg-info' : '' }}" name="country" id="country">
                <option value="">Any</option>
                @forelse ($countries as $country)
                    <option {{ request()->country == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                @empty
                    <option value="" disabled>No Countries Found</option>
                @endforelse
            </select>
        </div>
        <div class="form-group col-3">
            <label for="min_year">Min Year</label>
            <select class="form-control filter_s {{ request()->filled('min_year') ? 'bg-info' : '' }}" name="min_year" id="min_year">
                <option value="">Min Year</option>
                <option {{ request()->min_year == '2004' ? 'selected' : '' }} value="2004">2004</option>
                <option {{ request()->min_year == '2005' ? 'selected' : '' }} value="2005">2005</option>
                <option {{ request()->min_year == '2006' ? 'selected' : '' }} value="2006">2006</option>
                <option {{ request()->min_year == '2007' ? 'selected' : '' }} value="2007">2007</option>
                <option {{ request()->min_year == '2008' ? 'selected' : '' }} value="2008">2008</option>
                <option {{ request()->min_year == '2009' ? 'selected' : '' }} value="2009">2009</option>
                <option {{ request()->min_year == '2010' ? 'selected' : '' }} value="2010">2010</option>
                <option {{ request()->min_year == '2011' ? 'selected' : '' }} value="2011">2011</option>
                <option {{ request()->min_year == '2012' ? 'selected' : '' }} value="2012">2012</option>
                <option {{ request()->min_year == '2013' ? 'selected' : '' }} value="2013">2013</option>
                <option {{ request()->min_year == '2014' ? 'selected' : '' }} value="2014">2014</option>
                <option {{ request()->min_year == '2015' ? 'selected' : '' }} value="2015">2015</option>
                <option {{ request()->min_year == '2016' ? 'selected' : '' }} value="2016">2016</option>
                <option {{ request()->min_year == '2017' ? 'selected' : '' }} value="2017">2017</option>
                <option {{ request()->min_year == '2018' ? 'selected' : '' }} value="2018">2018</option>
                <option {{ request()->min_year == '2019' ? 'selected' : '' }} value="2019">2019</option>
                <option {{ request()->min_year == '2020' ? 'selected' : '' }} value="2020">2020</option>
                <option {{ request()->min_year == '2021' ? 'selected' : '' }} value="2021">2021</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="max_year">Max Year</label>
            <select class="form-control filter_s {{ request()->filled('max_year') ? 'bg-info' : '' }}" name="max_year" id="max_year">
                <option value="">Max Year</option>
                <option {{ request()->max_year == '2004' ? 'selected' : '' }} value="2004">2004</option>
                <option {{ request()->max_year == '2005' ? 'selected' : '' }} value="2005">2005</option>
                <option {{ request()->max_year == '2006' ? 'selected' : '' }} value="2006">2006</option>
                <option {{ request()->max_year == '2007' ? 'selected' : '' }} value="2007">2007</option>
                <option {{ request()->max_year == '2008' ? 'selected' : '' }} value="2008">2008</option>
                <option {{ request()->max_year == '2009' ? 'selected' : '' }} value="2009">2009</option>
                <option {{ request()->max_year == '2010' ? 'selected' : '' }} value="2010">2010</option>
                <option {{ request()->max_year == '2011' ? 'selected' : '' }} value="2011">2011</option>
                <option {{ request()->max_year == '2012' ? 'selected' : '' }} value="2012">2012</option>
                <option {{ request()->max_year == '2013' ? 'selected' : '' }} value="2013">2013</option>
                <option {{ request()->max_year == '2014' ? 'selected' : '' }} value="2014">2014</option>
                <option {{ request()->max_year == '2015' ? 'selected' : '' }} value="2015">2015</option>
                <option {{ request()->max_year == '2016' ? 'selected' : '' }} value="2016">2016</option>
                <option {{ request()->max_year == '2017' ? 'selected' : '' }} value="2017">2017</option>
                <option {{ request()->max_year == '2018' ? 'selected' : '' }} value="2018">2018</option>
                <option {{ request()->max_year == '2019' ? 'selected' : '' }} value="2019">2019</option>
                <option {{ request()->max_year == '2020' ? 'selected' : '' }} value="2020">2020</option>
                <option {{ request()->max_year == '2021' ? 'selected' : '' }} value="2021">2021</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="min_price">Min Price</label>
            <select class="form-control filter_s {{ request()->filled('min_price') ? 'bg-info' : '' }}" name="min_price" id="min_price">
                <option value="">Min Price</option>
                <option {{ request()->min_price == '5000' ? 'selected' : '' }} value="5000">USD 5000</option>
                <option {{ request()->min_price == '10000' ? 'selected' : '' }} value="10000">USD 10000</option>
                <option {{ request()->min_price == '15000' ? 'selected' : '' }} value="15000">USD 15000</option>
                <option {{ request()->min_price == '20000' ? 'selected' : '' }} value="20000">USD 20000</option>
                <option {{ request()->min_price == '25000' ? 'selected' : '' }} value="25000">USD 25000</option>
                <option {{ request()->min_price == '30000' ? 'selected' : '' }} value="30000">USD 30000</option>
                <option {{ request()->min_price == '35000' ? 'selected' : '' }} value="35000">USD 35000</option>
                <option {{ request()->min_price == '40000' ? 'selected' : '' }} value="40000">USD 40000</option>
                <option {{ request()->min_price == '45000' ? 'selected' : '' }} value="45000">USD 45000</option>
                <option {{ request()->min_price == '50000' ? 'selected' : '' }} value="50000">USD 50000</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="max_price">Max Price</label>
            <select class="form-control filter_s {{ request()->filled('max_price') ? 'bg-info' : '' }}" name="max_price" id="max_price">
                <option value="">Max Price</option>
                <option {{ request()->max_price == '5000' ? 'selected' : '' }} value="5000">USD 5000</option>
                <option {{ request()->max_price == '10000' ? 'selected' : '' }} value="10000">USD 10000</option>
                <option {{ request()->max_price == '15000' ? 'selected' : '' }} value="15000">USD 15000</option>
                <option {{ request()->max_price == '20000' ? 'selected' : '' }} value="20000">USD 20000</option>
                <option {{ request()->max_price == '25000' ? 'selected' : '' }} value="25000">USD 25000</option>
                <option {{ request()->max_price == '30000' ? 'selected' : '' }} value="30000">USD 30000</option>
                <option {{ request()->max_price == '35000' ? 'selected' : '' }} value="35000">USD 35000</option>
                <option {{ request()->max_price == '40000' ? 'selected' : '' }} value="40000">USD 40000</option>
                <option {{ request()->max_price == '45000' ? 'selected' : '' }} value="45000">USD 45000</option>
                <option {{ request()->max_price == '50000' ? 'selected' : '' }} value="50000">USD 50000</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="drive_type">Drive Type</label>
            <select class="form-control filter_s {{ request()->filled('drive_type') ? 'bg-info' : '' }}" name="drive_type" id="drive_type">
                <option value="">Any</option>
                <option {{ request()->drive_type == '2WD' ? 'selected' : '' }} value="2WD">2WD</option>
                <option {{ request()->drive_type == '4WD' ? 'selected' : '' }} value="4WD">4WD</option>
            </select>
        </div>
        <div class="form-group col-12">
            <input type="submit" value="Search" class="btn btn-sm btn-dark">
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-secondary">Reset</a>
        </div>
    </form>

    <div class="row">

        <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
            <p class="h4 text-danger">{{ $products->total() }} Products Found</p>
            <div class="d-flex justify-between">
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">Add New</a>
                <button id="bulkAvailable" class="btn btn-sm btn-primary mx-2">Bulk Available</button>
                <button id="bulkUnavailable" class="btn btn-sm btn-warning">Bulk Unavailable</butt>
                <button id="bulkSold" class="btn btn-sm btn-info mx-2">Bulk Sold</butt>
                <button id="bulkOnhold" class="btn btn-sm btn-secondary">Bulk Onhold</butt>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-hover table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>ID <input type="checkbox" name="all_vehicles" id="all_vehicles"></th>
                        <th>Status</th>
                        <th>Thumbnail</th>
                        <th>Ref#|Engine CC|Chasis#</th>
                        <th>Maker</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }} <input type="checkbox" class="vehicle_check" value="{{ $product->id }}"></td>
                            <td>
                                <form action="{{ route('products.status.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="product_status" id="product_status" class="form-control product_status">
                                        <option  {{ $product->sold == 0 ? 'selected' : '' }} value="0">Available</option>
                                        <option  {{ $product->sold == 1 ? 'selected' : '' }} value="1">Sold</option>
                                        <option  {{ $product->sold == 2 ? 'selected' : '' }} value="2">In Offer</option>
                                        <option  {{ $product->sold == 3 ? 'selected' : '' }} value="3">On Hold</option>
                                        <option  {{ $product->sold == 4 ? 'selected' : '' }} value="4">Hidden</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                {{-- <img src="{{ Storage::url($product->main_image_name) }}" class="img-fluid" width="150"> --}}
                                <img src="{{ asset($product->main_image_name) }}" class="img-fluid" width="150">
                            </td>
                            <td>{{ $product->ref_no . '|' . $product->engine_cc . '|' . $product->chassis_no }}</td>
                            <td>{{ $product->vcompany->name }}</td>
                            <td>{{ $product->vtype->name }}</td>
                            <td class="d-flex">
                                <a class="btn btn-sm btn-warning mr-2" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                </form>
                                <a href="{{ strtolower(route('landing.detail', [Str::slug($product->vcompany->name, '_'),  $product->drive_type ?: 'Both', Str::slug($product->vtype->name, '_'), $product->engine_cc, $product->ref_no])) }}" target="_blank" class="btn btn-sm btn-primary ml-2">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Products Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>

@endsection

@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){

            // submiForm = function(id){
            //     $("#updateStatusForm"+id).submit();
            // }

            $(".filter_s").change(function(){
                filterStock();
            });

            $(".filter_i").change(function(){
                filterStock();
            });

            function filterStock(){
                form = $("#stock_filter_form");
                dataString = form.serialize();

                axios.get('/api/stock/quantity?'+dataString)
                        .then(function(response){
                            console.log(response);
                            $("#stock_quantity").html("(" + response.data + " products found)");
                        })
                        .catch(function(error){
                            $("#stock_quantity").html('N/A');
                        });
            }

            $(".product_status").change(function(e){
                var statusValue = e.target.value;
                // alert(statusValue);
                console.log(statusValue);
                if(statusValue == 3){
                    var days =  prompt("Enter hold duration in days:", "2");
                    if(days != null){
                        var durationInput = document.createElement('input');
                        durationInput.name = "onhold_duration";
                        durationInput.value = days;
                        durationInput.type = "hidden";
                        var myForm = this.form;
                        myForm.append(durationInput);
                    }else{
                        return;
                    }
                //    console.log(this.form);
                }
                this.form.submit();
            });

            // select all vehicles
            $("#all_vehicles").change(function(){
                var allVehicles = document.getElementsByClassName("vehicle_check");
                // console.log(allVehicles);
                selectedVehicles = [];
                if(this.checked){
                    if (allVehicles.length > 0){
                        for (let i = 0; i < allVehicles.length; i++){
                            allVehicles[i].checked = true;
                            selecVehicle(allVehicles[i]);
                        }
                    }
                }else{
                    if (allVehicles.length > 0){
                        for (let i = 0; i < allVehicles.length; i++){
                            allVehicles[i].checked = false;
                            selecVehicle(allVehicles[i]);
                        }
                    }
                }
            });


            // bulk select
            var selectedVehicles = [];
            $(".vehicle_check").change(function(){
                selecVehicle(this);
            });

            function selecVehicle(e){
                if(e.checked){
                    selectedVehicles.push(e.value);
                }else{
                    var index = selectedVehicles.indexOf(e.value);
                    if(index > -1){
                        selectedVehicles.splice(index, 1)
                    }
                }
                console.log(selectedVehicles);
            }

            // change bulk status
            $("#bulkAvailable").click(function(){
                if(selectedVehicles.length > 0){
                    window.location = '/admin/products/bulk/available?vehicles='+selectedVehicles;
                }else{
                    // alert('No Vehicles selected');
                    Swal.fire({
                        title: 'Error!',
                        text: 'No Vehicles Selected',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });

            $("#bulkUnavailable").click(function(){
                if(selectedVehicles.length > 0){
                    window.location = '/admin/products/bulk/unavailable?vehicles='+selectedVehicles;
                }else{
                    // alert('No Vehicles selected');
                    Swal.fire({
                        title: 'Error!',
                        text: 'No Vehicles Selected',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });

            $("#bulkSold").click(function(){
                if(selectedVehicles.length > 0){
                    window.location = '/admin/products/bulk/sold?vehicles='+selectedVehicles;
                }else{
                    // alert('No Vehicles selected');
                    Swal.fire({
                        title: 'Error!',
                        text: 'No Vehicles Selected',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });

            $("#bulkOnhold").click(function(){
                if(selectedVehicles.length > 0){
                    var days =  prompt("Enter hold duration in days:", "2");
                    if(days != null){
                        var onhold_duration = days;
                    }else{
                        return;
                    }
                    window.location = '/admin/products/bulk/onhold?vehicles='+selectedVehicles+'&onhold_duration='+onhold_duration;
                }else{
                    // alert('No Vehicles selected');
                    Swal.fire({
                        title: 'Error!',
                        text: 'No Vehicles Selected',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });

        });
    </script>
@endpush
