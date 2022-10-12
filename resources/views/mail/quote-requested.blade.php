<table style="width: 50%; margin: auto; padding: 10px; background-color: aliceblue;">
    <tr>
        <td style="text-align: center; color: lightblue;"><h2>Thank You, your inquiry was submitted</h2></td>
    </tr>
    <tr style="text-align: center;">
        <td>
            <img src="{{$url_img}}" alt="logo" style="margin-top: 10px; margin-bottom: 10px;">
        </td>
    </tr>
    <tr style="text-align: center;">
        <td>
            You will recieve an email shortly with the <b>Price Quote</b> related to {{ $quote->product->ref_no ?? '' }} {{ $quote->product->vcompany->name ?? '' }}.
            <br>
            If you have more questions, please reply to this email so we can assist you.
        </td>
    </tr>
    <tr>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <a href="{{ route('landing.index') }}">Go to website</a>
        </td>
    </tr>
</table>
