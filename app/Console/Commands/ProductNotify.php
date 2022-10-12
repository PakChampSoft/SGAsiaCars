<?php

namespace App\Console\Commands;

use App\Mail\ProductNotificationMail;
use App\Models\ProductNotifcation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProductNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to thos users who subscribed for onhold products';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $notifications = ProductNotifcation::where('notified', 0)->with('user', 'product', 'product.vcompany', 'product.vtype')->get();
        // dd($notifications->toArray());
        foreach($notifications as $notification){
            $product = $notification->product;

            if($product->sold == 3){
                $productHoldTime = $product->onhold_duration;
                $timeNow = Carbon::now();
                if($timeNow->gt($productHoldTime)){
                    $product->sold = 0;
                    $product->save();

                    $notification->notified = 1;
                    $notification->save();

                    $user = $notification->user;

                    Mail::to($user->email)->send(new ProductNotificationMail($product));
                }
            }
        }

        $this->info('Notifications sent!');
        // return Command::SUCCESS;
    }
}
