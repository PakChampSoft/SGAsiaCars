<table style="width: 50%; margin: auto; padding: 10px; background-color: aliceblue;">
    <tr>
        <td style="text-align: center; color: lightblue;"><h2>Notification for OnHold Vehicle</h2></td>
    </tr>
    <tr style="text-align: center;">
        <td>
            <img src="{{$url_img}}" alt="logo" style="margin-top: 10px; margin-bottom: 10px;">
        </td>
    </tr>
    <tr style="text-align: center;">
        <td>
            {{ $product->ref_no ?? '' }} {{ $product->vcompany->name ?? '' }} {{ $product->vtype->name ?? '' }} is available now.</br>
        </td>
    </tr>
    <tr>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td>
            Ref#
        </td>
        <td>
            {{ $product->ref_no ?? '' }}
        </td>
    </tr>
    <tr>
        <td>
            Company
        </td>
        <td>
            {{ $product->vcompany->name ?? '' }}
        </td>
    </tr>
    <tr>
        <td>
            Type
        </td>
        <td>
            {{ $product->vtype->name ?? '' }}
        </td>
    </tr>
    <tr>
        <td>
            Color
        </td>
        <td>
            {{ $product->vcolor->name ?? '' }}
        </td>
    </tr>
    <tr>
        <td>
            Transmission
        </td>
        <td>
            {{ $product->transmission ?? '' }}
        </td>
    </tr>
    <tr>
        <td>
            Steering
        </td>
        <td>
            {{ $product->steering ?? '' }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <a href="{{ route('landing.index') }}">Go to website</a>
        </td>
    </tr>
</table>
