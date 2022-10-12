<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Deal;
use App\Models\Port;
use App\Models\Type;
use App\Models\Color;
use App\Models\VModel;
use App\Mail\ContactUs;
use App\Models\Company;
use App\Models\Country;
use App\Models\Product;
use App\Models\PageMeta;
use App\Rules\Recaptcha;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LandingPageController extends Controller
{
    public function index()
    {

        $pageTitle = 'Home';
        // $companies = Company::withCount(['products' => function($qry){
        //     $qry->where('sold', '!=', 4);
        // }])->get();
        // dd($companies->toArray());
        // $types = Type::all();
        // $colors = Color::all();
        // $models = VModel::withCount(['products' => function($qry){
        //     $qry->where('sold', '!=', 4);
        // }])->get();
        // $countries = Country::all();

        // new arrivals products
        $newArrivals = Product::where('sold', '!=', 4)->with('vcompany', 'v_model', 'vtype')
                                ->orderBy('id', 'desc')
                                ->limit(6)
                                ->get();
        // $newArrivals=[];
        // featured products
        $featured = Product::where('sold', '!=', 4)->with('vcompany', 'v_model', 'vtype')
                                ->where('is_featured', 1)
                                ->orderBy('id', 'desc')
                                ->limit(6)
                                ->get();

        // discounted products
        $discounted = Product::where('sold', '!=', 4)->with('vcompany', 'v_model', 'vtype')
                                ->whereHas('deal', function($qry){
                                    $qry->where('title', 'DISCOUNTED');
                                })
                                ->orderBy('id', 'desc')
                                ->limit(6)
                                ->get();

        // best deals products
        $bestdeals = Product::where('sold', '!=', 4)->with('vcompany', 'v_model', 'vtype')
                                ->whereHas('deal', function($qry){
                                    $qry->where('title', 'BEST DEALS');
                                })
                                ->orderBy('id', 'desc')
                                ->limit(6)
                                ->get();

        // premium vip products
        $premium = Product::where('sold', '!=', 4)->with('vcompany', 'v_model', 'vtype')
                                ->whereHas('deal', function($qry){
                                    $qry->where('title', 'PREMIUM / VIP');
                                })
                                ->orderBy('id', 'desc')
                                ->limit(6)
                                ->get();

        $pagedata = PageMeta::where('page_url', '/')->first();
        // return view('home', compact('newArrivals', 'featured', 'discounted', 'bestdeals', 'premium', 'pageTitle', 'pagedata'));
        return view('new_website.home', compact('newArrivals','featured','discounted', 'bestdeals', 'premium', 'pagedata'));
    }

    public function productDetail($company = null, $type = null, $transmission = null, $engine = null, $ref_no)
    {
        $product = Product::where('sold', '!=', 4)->where('ref_no', $ref_no)
                            ->with('vcompany', 'v_model', 'vtype', 'vcountry')
                            ->firstOrFail();
        if($product)
        {
            $pageTitle = $product->vcompany->name . ' ' . $product->vtype->name . ' ' . $product->transmission;
            $seo_title = $product->meta_title;
            // dd($seo_title);
            $meta_description =  $product->meta_description;
            $meta_keywords =    $product->meta_keywords;
            $pagedata = "";
            $accessories = Accessory::all();

            $countries = Country::whereHas('ports')->get();

            $location = $this->getLocation();

            $similarProducts = Product::where('sold', '!=', 4)->where('company',$product->company)
                                        ->where('type', $product->type)
                                        ->where('id', '!=', $product->id)
                                        ->with(['vcompany', 'vtype'])
                                        ->limit(16)
                                        ->inRandomOrder()
                                        ->get();


            if($product->sold == 3){
                $productHoldTime = $product->onhold_duration;
                $timeNow = Carbon::now();
                if($timeNow->gt($productHoldTime)){
                    $product->sold = 0;
                    $product->save();
                }
            }

            // $similarProducts = Product::where('sold', '!=', 4)->whereHas('vcompany', function($qry)use($company){
            //                                 $qry->where('name', $company);
            //                             })
            //                             ->whereHas('v_model', function($qry)use($model){
            //                                 $qry->where('name', $model);
            //                             })
            //                             ->whereHas('vtype', function($qry)use($type){
            //                                 $qry->where('name', $type);
            //                             })
            //                             ->with('vcompany')
            //                             ->limit(16)
            //                             ->inRandomOrder()
            //                             ->get();
            // return view('detail', compact('product', 'accessories', 'similarProducts', 'countries', 'location', 'pageTitle', 'meta_description', 'meta_keywords', 'seo_title', 'pagedata'));
            return view('new_website.details', compact('product', 'accessories', 'similarProducts', 'countries', 'location', 'pageTitle', 'meta_description', 'meta_keywords', 'seo_title', 'pagedata'));
        }
        else
        {
            redirect()->route('landing.index');
        }


    }

    public function stockList(Request $request)
    {
        $query = Product::where('sold', '!=', 4)->orderBy('id', 'desc');

        if($request->filled('ref_no')){
            $query->where('ref_no', $request->ref_no);
        }

        if($request->filled('maker')){
            $query->where('company', $request->maker);
        }

        if($request->filled('model')){
            $query->where('vmodel', $request->model);
        }

        if($request->filled('type')){
            $query->where('type', $request->type);
        }

        if($request->filled('color')){
            $query->where('color', $request->color);
        }

        if($request->filled('fuel')){
            $query->where('fuel_type', 'like', '%'.$request->fuel.'%');
        }

        if($request->filled('year_from')){
            $query->where('manufacture_date', '>=', $request->year_from);
        }

        if($request->filled('year_to')){
            $query->where('manufacture_date', '<=', $request->year_to);
        }

        // adding date
        if($request->filled('date_from')){
            $query->whereDate('created_at', $request->date_from);
        }
        // end adding date

        if($request->filled('enginecc_from')){
            $query->where('engine_cc', '>=', (int) $request->enginecc_from);
        }

        if($request->filled('enginecc_to')){
            $query->where('engine_cc', '<=', (int) $request->enginecc_to);
        }

        if($request->filled('min_price')){
            $query->where('price', '>=', (int) $request->min_price);
        }

        if($request->filled('max_price')){
            $query->where('price', '<=', (int) $request->max_price);
        }

        if($request->filled('drive_type')){
            $query->where('drive_type', $request->drive_type);
        }

        if($request->filled('transmission')){
            $query->where('transmission', $request->transmission);
        }

        if($request->filled('steering')){
            $query->where('steering', $request->steering);
        }

        if($request->filled('min_seats')){
            $query->where('seats', '>=', (int) $request->min_seats);
        }

        if($request->filled('max_seats')){
            $query->where('seats', '<=', (int) $request->max_seats);
        }

        if(request()->filled('min_mileage')){
            $query->where('mileage', '>=', (int) $request->min_mileage);
        }

        if(request()->filled('max_mileage')){
            $query->where('mileage', '<=', (int) $request->max_mileage);
        }

        if($request->filled('stock_country')){
            $query->where('country', $request->stock_country);
        }

        if($request->filled('featured')){
            $query->where('is_featured', $request->featured);
        }

        if($request->filled('deal')){
            $query->where('deal', $request->deal);
        }

        if($request->filled('deals')){
            $query->whereIn('deal', $request->deals);
        }

        if($request->filled('asscs')){
            $accessories = $request->asscs;
            // $query->where('accessories', array_map('intval', $accessories));
            $query->where('accessories', implode(',',$accessories));
            // $query->where('accessories', $accessories);
        }
        // if($request->filled('country_ports')){
        //     $query->where('country', $request->country_ports);
        // }


        $perPage = 10;
        if($request->filled('items_per_page')){
            $perPage = $request->items_per_page;
        }

        $query->with('vcompany', 'v_model', 'vtype');

        $products = $query->paginate($perPage);
        // dd($products->toArray());

        $pageTitle = 'Stocklist';

        // $companies = Company::withCount('products')->get();
        // $models = VModel::withCount('products')->get();
        // $types = Type::all();
        // $colors = Color::all();
        // $countries = Country::all();

        $location = $this->getLocation();
        $stockCountry = Country::where('name', $location)->first();
        // $port = Port::where('country_id', $stockCountry->id)->first();
        $port = null;
        if($request->filled('country_ports')){
            $port = Port::where('id', $request->country_ports)->first();
        }else{
            $port = Port::where('country_id', $stockCountry->id)->first();
        }

        $accessories = Accessory::all();
        $deals = Deal::all();

        // return view('stocklist', compact('products', 'accessories', 'deals', 'stockCountry', 'port', 'pageTitle'));

        return view('new_website.stocklist', compact('products', 'accessories', 'deals', 'stockCountry', 'port', 'pageTitle'));

    }


    public function fullTextSearch(Request $request)
    {
        $qry = $request->qry;

        // $products = Product::where('sold', '!=', 4)->search($qry)->orderBy('id', 'desc')->paginate(10);

        $products = Product::where('sold', '!=', 4)->whereHas('vcompany', function($q)use($qry){
                                $q->where('name', 'LIKE', '%' . $qry . '%');
                            })
                            ->orWhereHas('v_model', function($q)use($qry){
                                $q->where('name', 'LIKE', '%' . $qry . '%');
                            })
                            ->orWhere('ref_no', $qry)
                            ->orWhere('id', $qry)
                            ->orWhere('chassis_no', $qry)
                            ->paginate(10);

        $products->load('vcompany', 'v_model', 'vtype');

        $pageTitle = $qry ?? '' . ' | Search';

        $companies = Company::withCount('products')->get();
        $models = VModel::withCount('products')->get();
        $types = Type::all();
        $colors = Color::all();
        $countries = Country::all();

        $location = $this->getLocation();
        $stockCountry = Country::where('name', $location)->first();
        $port = Port::where('country_id', $stockCountry->id)->first();


        $accessories = Accessory::all();
        $deals = Deal::all();

        return view('new_website.stocklist', compact('products', 'accessories', 'companies', 'models', 'types', 'colors', 'countries', 'deals', 'stockCountry', 'port', 'pageTitle'));
    }

    // blogs
    public function blogs()
    {
        $pageTitle = "Blogs";
        $pagedata = PageMeta::where('page_url', 'blogs')->first();
        $blogs = Blog::whereDate('published_at','<=', Carbon::today()->toDateString())->with('user')->latest()->paginate(10);
        $latestBlogs = Blog::whereDate('published_at','<=', Carbon::today()->toDateString())->latest()->limit(4)->get();

        return view('blogs', compact('blogs', 'latestBlogs', 'pageTitle','pagedata'));
    }

    public function showBlog($slug)
    {
        $pageTitle = "Blog Show";
        $blog = Blog::with('user')->where('slug', $slug)->firstOrFail();

        $blog->increment('views');
        $pagedata = "";
        return view('show-blog', compact('blog', 'pageTitle','pagedata'));
    }

    public function contactUsForm()
    {
        $pagedata = PageMeta::where('page_url', 'toyota-4wd-hilux')->first();
        $pageTitle = $pagedata->page_name;
        $countries = Country::all();
        return view('new_website.contact-us', compact('countries', 'pageTitle', 'pagedata'));
    }

    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'subject' => 'required',
            'message' => 'required',
            // 'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);

        try {
            Mail::to(env('ADMIN_EMAIL'))->cc([env('CC_EMAIL')])->send(new ContactUs($request));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return redirect()->route('contact_redirect_thanks')->with('message', 'Thank You For Contacting Us, Our Team Will Contact You Soon!');

    }

    public function contact_redirect_thanks()
    {
        return view('new_website.contact-us-thanks');
    }

    public function shownew($company,$url, Request $request){

        $url= explode('-', $url);
        $lastkey=array_key_last ($url);
        $ref_no=$url[$lastkey];

        dd($ref_no);

    }
}
