<table
  style="width: 50%; margin: auto; padding: 10px; background-color: aliceblue"
  border="1"
>
  <tbody>
    <tr>
      <td
        colspan="2"
        style="
          text-align: center;
          font-size: 20px;
          color: lightblue;
        "
      >
        New Inquiry message from {{ $quote->fullname }}
      </td>
    </tr>
    <tr>
      <td>Name</td>
      <td>{{ $quote->fullname }}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>{{ $quote->email }}</td>
    </tr>
    <tr>
      <td>Telephone</td>
      <td>{{ $quote->tel }}</td>
    </tr>
    <tr>
      <td>Country</td>
      <td>{{ $quote->country }}</td>
    </tr>
    <tr>
      <td>City</td>
      <td>{{ $quote->city }}</td>
    </tr>
    <tr>
      <td>Address</td>
      <td>{{ $quote->address }}</td>
    </tr>
    <tr>
      <td>Client IP</td>
      <td>{{ request()->ip() }}</td>
    </tr>
    <tr>
      <td>Date</td>
      <td>{{ \Carbon\Carbon::today()->format('d-m-Y') }}</td>
    </tr>
    <tr>
      <td>Vehicle</td>
      <td>{{ $quote->product->ref_no ?? '' }} {{ $quote->product->vcompany->name ?? '' }}  {{ $quote->product->manufacture_date ?? '' }}</td>
    </tr>
    <tr>
      <td>Year</td>
      <td>{{ $quote->product->manufacture_date ?? '' }}</td>
    </tr>
    <tr>
      <td>Engine</td>
      <td>{{ $quote->product->engine_cc ?? '' }}</td>
    </tr>
    <tr>
      <td>Mileage</td>
      <td>{{ $quote->product->mileage ?? '' }}</td>
    </tr>
    <tr>
      <td>Steering</td>
      <td>{{ $quote->product->steering ?? '' }}</td>
    </tr>
    <tr>
      <td>Trans</td>
      <td>{{ $quote->product->transmission ?? '' }}</td>
    </tr>
  </tbody>
</table>
<br>

<h5 style="width: 50%; margin: auto; padding: 10px 0px 10px 0; background-color: aliceblue">This email was sent by SGASIACARS for {{ $quote->product->vcompany->name ?? '' }} {{ $quote->product->vtype->name ?? '' }}</h5>
