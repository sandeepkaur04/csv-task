<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        if($request->isMethod('post')) {
            $info = pathinfo($_FILES['output']['name']);
            $extension = $info['extension'];
            $new_name = 'output.'.$extension;
            // echo '<pre>'; print_r($_FILES); die;
            if($extension == 'csv'){
                $file_path = storage_path().'/app/public' ;
                move_uploaded_file($_FILES['output']['tmp_name'], $file_path.'/'.$new_name);
                return redirect('/result');
            }
        }
        return view('welcome');
    }

    public function result() {
        $records = [];
        if (($open = fopen(storage_path() . "/app/public/output.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        
                $records[] = $data;
        
            }
            fclose($open);
        }

        // arrange the array values
        $result = [];
        foreach ($records as $key => $value) {
            if($key > 0) {
                $obj = new \stdClass();

                $obj->school_URN = $value[0];
                $obj->organization_name = $value[1];
                $obj->organization_telephone = $value[2];
                $obj->organization_email = $value[3];
                $obj->organization_url = $value[4];
                $obj->order_id = $value[5];
                $obj->order_total = $value[17];

                $obj->order = new \stdClass();
                $obj->order->date = $value[6];
                $obj->order->name = $value[7];
                $obj->order->contact_name = $value[8];
                $obj->order->email_address = $value[9];
                $obj->order->telephone = $value[10];

                $obj->delivery_address = new \stdClass();
                $obj->delivery_address->address_1 = $value[11];
                $obj->delivery_address->address_2 = $value[12];
                $obj->delivery_address->address_3 = $value[13];
                $obj->delivery_address->town = $value[14];
                $obj->delivery_address->county = $value[15];
                $obj->delivery_address->postcode = $value[16];

                $obj->product = [];
                $prod_data = new \stdClass();
                $prod_data->colour_style_ref = $value[18];
                $prod_data->name = $value[19];
                $prod_data->colour_name = $value[20];
                $prod_data->size_name = $value[21];
                $prod_data->colour_image_url = $value[22];
                $prod_data->ean = $value[23];
                $prod_data->price = $value[24];
                $prod_data->quantity = $value[25];
                $prod_data->line_price = $value[26];
                
                array_push($obj->product, $prod_data);

                array_push($result, $obj);
            }
        }

        // combine the objects which are having same order-id
        $duplicate = $result;
        foreach ($result as $key => $value) {

            foreach ($duplicate as $key2 => $value2) {
                if($key != $key2) {
                    if($value->order_id === $value2->order_id) {
                        array_push($value->product, $value2->product[0]);
                        unset($duplicate[$key2]);
                    }
                    
                }
            }

            // remove all the objects with same order id from result
            foreach ($result as $key3 => $value3) {
                if($key < $key3) {
                    if($value->order_id === $value3->order_id) {
                        unset($result[$key3]);
                    }
                    
                }
            }
        }

        return view('result', compact('result'));
    }
}
