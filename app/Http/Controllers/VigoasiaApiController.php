<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Color;
use App\Models\Company;
use App\Models\Country;
use App\Models\Deal;
use App\Models\Port;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Type;
use App\Models\VModel;
use Illuminate\Http\Request;
use DB;
use Image;

class VigoasiaApiController extends Controller
{
    public function index()
    {
        $this->vigo4udubaicreate();
        // $this->portcolor();
        // $this->portcreate();
        // $this->create();

        dd('Completed');
    }

    private function portcolor()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://vigoasia.com//outsource/api",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 21d51fb1-d2bf-e565-9bc9-de01798f0508"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $dataa = json_decode($response);
        $data = $dataa->Color;
        foreach($data as $item)
        {

            $color = DB::table('color')->where('name',$item->name)->first();
            if(isset($color->id))
            {
            }
            else
            {
                $color = Color::create([
                    'name' => $item->name,
                    'status' => 1
                ]);

            }


        }


    }

     private function portcreate()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://vigoasia.com//outsource/api",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 21d51fb1-d2bf-e565-9bc9-de01798f0508"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $dataa = json_decode($response);
        $data = $dataa->Port;
        foreach($data as $item)
        {

            $port = DB::table('ports')->where('name',$item->name)->where('country_id',$item->country_id)->first();
            if(isset($port->id))
            {
            }
            else
            {
                $port = Port::create([
                    'country_id' => $item->country_id,
                    'name' => $item->name,
                    'amount' => $item->amount,
                ]);

            }


        }


    }


    private function create()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://vigoasia.com//outsource/api",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 21d51fb1-d2bf-e565-9bc9-de01798f0508"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $dataa = json_decode($response);
        $data = $dataa->Products;
        foreach($data as $item)
        {
            $item->ref_no=trim($item->ref_no,'BH');
            $check=Product::where('ref_no',$item->ref_no)->first();

            if($check == null)
            {

                if(!empty($item->images) && isset($item->product_type->type))
                {
                    $mileage = str_replace("("," ",$item->mileage);
                    $mileage = str_replace(")"," ",$mileage);


                    $data=[
                    'ref_no' => $item->ref_no,
                    'company' => $this->vigoasiamake($item->product_company->name),
                    'type' => $this->vigoasiatype($item->product_type->type),
                    'steering' => isset($item->steering) ? $item->steering : 'none',
                    'is_featured' => 1,
                    'transmission' => $item->transmission,
                    'mileage' => $mileage,
                    'engine_cc' => $item->engine_cc,
                    'chassis_no' => $item->chassis_no,
                    'grade' => $item->grade,
                    'manufacture_date' => $item->registration_date,
                    'fuel_type' => $item->fuel_type,
                    'drive_type' => isset($item->drive_type) ? $item->drive_type : null,
                    'color' => $item->color,
                    'no_of_doors' => $item->no_of_doors,
                    'seats' => $item->seats,
                    'size' => isset($item->size) ? $item->size : null,
                    'country' => $item->country->id,
                    'price' => $item->price,
                    'accessories' => $item->accessories,
                    'vigoasiabit' => 1
                    ];

                    $product = Product::create($data);


                    $this->vigoasiaphoto_upload($item->images,$item->ref_no);



                }


            }
            else
            {
                // $mileage = str_replace("("," ",$item->mileage);
                // $mileage = str_replace(")"," ",$mileage);
                // $data=[
                //     'mileage' => $mileage,
                //     'country' => $item->country->id,
                //     'accessories' => $item->accessories,
                //     'color' => $item->color,
                //     ];

                //     Product::where('ref_no', $item->ref_no)->update($data);
            }


        }

    }





    private function vigo4udubaicreate()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://vigo4u-dubai.com//outsource/api",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 21d51fb1-d2bf-e565-9bc9-de01798f0508"
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $dataa = json_decode($response);

        $data = $dataa->Products;

        foreach($data as $item)
        {
            dd($item->ref_no);
            $item->ref_no=trim($item->ref_no,'BH');
            $check=Product::where('ref_no',$item->ref_no)->first();

            if($check == null)
            {
                if(!empty($item->galleries) && isset($item->product_body_type->title) && isset($item->brand->title))
                {
                    $data=[
                    'ref_no' => $item->ref_no,
                    'company' => $this->vigoasiamake($item->brand->title),
                    'type' => $this->vigoasiatype($item->product_body_type->title),
                    'steering' => isset($item->steering) ? $item->steering : 'none',
                    'is_featured' => 1,
                    'transmission' => $item->transmission,
                    'mileage' => $item->mileage,
                    'engine_cc' => $item->engine_size,
                    'chassis_no' => $item->chassis_no,
                    'manufacture_date' => $item->years,
                    'fuel_type' => $item->fuel,
                    'drive_type' => isset($item->drivetrain) ? $item->drivetrain : null,
                    'color' => $this->vigoasiacolor($item->colors),
                    'no_of_doors' => $item->doors,
                    'seats' => $item->seats,
                    'price' => $item->price,
                    'vigoasiabit' => 2
                    ];
                    $product = Product::create($data);


                    $this->vigodubaiphoto_upload($item->galleries,$item->ref_no);



                }


            }
            else
            {
                // $mileage = str_replace("("," ",$item->mileage);
                // $mileage = str_replace(")"," ",$mileage);
                // $data=[
                //     'mileage' => $mileage,
                //     'country' => $item->country->id,
                //     'accessories' => $item->accessories,
                //     'color' => $item->color,
                //     ];

                //     Product::where('ref_no', $item->ref_no)->update($data);
            }

        }

    }




































    private function vigoasiagetAccessories($request)
    {

        $request=explode(',',$request);
        $idsarray = array();
        foreach ($request as $key)
        {
          $id = DB::table('accessories')->where('name',$key)->pluck('id');
          if(isset($id[0]))
          {
            $idsarray[]=$id[0];
          }
          else
          {
                if($key != null)
                {
                    $idd = DB::table('accessories')->insertGetId([
                    'name' => $key,
                    'status' => 1
                    ]);
                    $idsarray[]=$idd;
                }
          }

        }
        $ids = implode(',', $idsarray);
        return $ids;
    }
    private function vigoasiamake($request)
    {
        $id = DB::table('company')->where('name',$request)->pluck('id');
        if(isset($id[0]))
        {
          return $id[0];
        }
        else
        {
            $data = [
                'name' => $request,
                'status' => 1
            ];
            $company=Company::create($data);
            return $company->id;
        }
    }
    private function vigoasiavmodel($vmodel,$companyid)
    {
        $id = DB::table('vmodel')->where('company_id',$companyid)->where('name',$vmodel)->pluck('id');
        if(isset($id[0]))
        {
          return $id[0];
        }
        else
        {
            $data = [
                'name' => $vmodel,
                'company_id' => $companyid,
                'status' => 1
            ];
            $vmodel=Vmodel::create($data);
            return $vmodel->id;
        }
    }
    private function vigoasiatype($request)
    {
        $id = DB::table('type')->where('name',$request)->pluck('id');
        if(isset($id[0]))
        {
          return $id[0];
        }
        else
        {
           $data = [
                'name' => $request,
                'status' => 1
            ];
            $type=Type::create($data);
            return $type->id;
        }
    }
    private function vigoasiacolor($request)
    {
        if($request != null)
        {
                $color = ucwords(strtolower($request));
                $id = DB::table('color')->where('name',$color)->pluck('id');
                if(isset($id[0]))
                {
                  return $id[0];
                }
                else
                {
                   $data = [
                        'name' => $request,
                        'status' => 1
                    ];
                    $color=Color::create($data);
                    return $color->id;
                }
        }
        else
        {
            return 0;
        }

    }
    private function vigodubaiphoto_upload($request,$ref_no)
    {

        $product = DB::table('product')->where('ref_no',$ref_no)->first();
        $product_id=$product->id;

        $imageslinks = $request;
        $product=Product::find($product_id);
        $photos_path = public_path().'/product_photos';
        $path=$photos_path.'/'.$product->ref_no;



        if (!is_dir($path)) {
            $checkmakedire = $this->makedirs($path, 0775);
        }




        $i=0;
        foreach ($imageslinks as $link)
        {

           $link="https://vigo4u-dubai.com/public/".$link->gallery;

            $temp_save_name = uniqid() . '.jpg';
            $file_loc=$path.'/'.$temp_save_name;

            $img = Image::make($link);
            $img->resize(700,500);
            $img->text('SG CARS Ref#:'.$ref_no, 350, 500-50, function($constraint){
                    $constraint->file(public_path('fonts/Cocola.ttf'));
                    $constraint->size(24);
                    $constraint->color(array(255, 255, 255, 0.4));
                    $constraint->align('center');
                    $constraint->valign('top');
                })->save($file_loc);




            Photo::create([
             'product_id' => $product_id,
             'name' => '/product_photos/'.$ref_no.'/'.$temp_save_name
            ]);



            if($i==0)
            {
                 $data=[
                 'main_image_name' => '/product_photos/'.$ref_no.'/'.$temp_save_name
                ];
                Product::where(['ref_no'=> $product->ref_no])->update($data);
            }
            $i++;
        }
    }
    private function vigoasiaphoto_upload($request,$ref_no)
    {

        $product = DB::table('product')->where('ref_no',$ref_no)->first();
        $product_id=$product->id;

        $imageslinks = $request;
        $product=Product::find($product_id);
        $photos_path = public_path().'/product_photos';
        $path=$photos_path.'/'.$product->ref_no;



        if (!is_dir($path)) {
            $checkmakedire = $this->makedirs($path, 0775);
        }




        $i=0;
        foreach ($imageslinks as $link)
        {
           $link = "https://vigoasia.com/".$link->path;

            $temp_save_name = uniqid() . '.jpg';
            $file_loc=$path.'/'.$temp_save_name;

            $img = Image::make($link);
            $img->resize(700,500);
            $img->text('SG CARS Ref#:'.$ref_no, 350, 500-50, function($constraint){
                    $constraint->file(public_path('fonts/Cocola.ttf'));
                    $constraint->size(24);
                    $constraint->color(array(255, 255, 255, 0.4));
                    $constraint->align('center');
                    $constraint->valign('top');
                })->save($file_loc);




            Photo::create([
             'product_id' => $product_id,
             'name' => '/product_photos/'.$ref_no.'/'.$temp_save_name
            ]);



            if($i==0)
            {
                 $data=[
                 'main_image_name' => '/product_photos/'.$ref_no.'/'.$temp_save_name
                ];
                Product::where(['ref_no'=> $product->ref_no])->update($data);
            }
            $i++;
        }
    }
    private function makedirs($dirpath, $mode = 0775, $recursive = true)
    {
        $oldMask=umask(002);
        $status = is_dir($dirpath) || mkdir($dirpath, $mode, $recursive);
        umask($oldMask);
        return $status;
    }
    private function vigoasiacountry($request)
    {

        $id = DB::table('country')->where('name',$request->name)->pluck('id');
        if(isset($id[0]))
        {
          return $id[0];
        }
        else
        {
           $data = [
                'name' => $request->name,
                'status' => 1
            ];
            $country=Country::create($data);
            return $country->id;
        }
    }


}
