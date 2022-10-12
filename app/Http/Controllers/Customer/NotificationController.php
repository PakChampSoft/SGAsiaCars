<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ProductNotifcation;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifyMe($product)
    {
        // dd($product);
        $notification = ProductNotifcation::updateOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product,
            'notified' => 0,
        ],[
            'user_id' => auth()->id(),
            'product_id' => $product,
            'type' => request()->type ?? 'hold'
        ]);

        toastr()->success('Product added to notification list');

        return redirect()->back();
    }

    public function myNotifications()
    {

        $pageTitle = "My Notifications";

        $query = ProductNotifcation::where('user_id', auth()->id())
                            ->with('user', 'product', 'product.vcompany', 'product.vtype');

        if(request()->filled('from')){
            $query->whereDate('created_at', '>=',  request()->from);
        }

        if(request()->filled('to')){
            $query->whereDate('created_at', '<=' ,request()->to);
        }

        $notifications = $query->latest()->paginate(50);

        // dd($notifications->toArray());

        return view('customer.notify.index', compact('notifications', 'pageTitle'));
    }
}
