<div style="width: 80%; margin: auto; padding: 10px; background-color: aliceblue;">

    <h3 style="text-align: center">New Message from {{ $data->name }}</h3>
    <h5>Email: {{ $data->email }}</h5>
    <h5>Phone: {{ $data->phone }}</h5>
    <h5>Country: {{ $data->country }}</h5>
    <p>{{ $data->message }}</p>

    <br>

    <p style="text-align: center">
        <img src="{{ asset('images/SG logo.png') }}" alt="logo">
    </p>

</div>
