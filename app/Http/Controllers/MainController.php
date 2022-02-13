<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Question;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;

class MainController extends Controller
{
    public function upload_product(Request $request)
    {
      

        if ($request->isMethod("POST")) {
            $request->validate([
                "product_name" => "required",
                "price" => "required",
                "product_old_price" => "required",
                "product_description" => "required",
                "category" => "required",
                "brand" => "required",
                "product_image1" => "required",
                "product_image2" => "required",
                "product_image3" => "required",
                "product_image4" => "required",
            ]);


            $product = $request->all();
            $product_image1 = $request->file("product_image1")->getClientOriginalName();
            $destination1 = $request->product_image1->move(("images"), $product_image1);
            $product_image2 = $request->file("product_image2")->getClientOriginalName();
            $destination2 = $request->product_image2->move(("images"), $product_image2);
            $product_image3 = $request->file("product_image3")->getClientOriginalName();
            $destination3 = $request->product_image3->move(("images"), $product_image3);
            $product_image4 = $request->file("product_image4")->getClientOriginalName();
            $destination4 = $request->product_image4->move(("images"), $product_image4);


            $product["product_image1"] = $destination1;
            $product["product_image2"] = $destination2;
            $product["product_image3"] = $destination3;
            $product["product_image4"] = $destination4;

            dd($product);
            $save_product = Product::create($product);
            if ($save_product) {
                dd("HAHAH");
            }
        }

        $categories = Category::all();
        $brands = Brand::all();

        return view("home", compact("categories", "brands"));
    }


    public function products()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return response()->json($products);
    }

    public function featured_products()
    {
        $featured_products = Product::where("featured", "Yes")->get();
        return response()->json($featured_products);
    }
    public function trending_products()
    {
        $trending_products = Product::where("trending", "Yes")->get();
        return response()->json($trending_products);
    }

    

    public function products_per_page($num)
    {
        $products = Product::paginate($num);
        return response()->json($products);
    }


    public function upload_faq(Request $request)
    {

        if ($request->isMethod("POST")) {
            // dd($request);
            $request->validate([
                "question" => "required",
                "answer" => "required",
            ]);
            $faq = $request->all();

            $save_faq = Faq::create($faq);
            if ($save_faq) {
                return ("faq saved");
            }
        }

        return view("faq");
    }

    public function faqs()
    {

        $faqs = Faq::all();
        return response()->json($faqs);
    }

    public function add_question(Request $request)
    {
        if ($request->isMethod("POST")) {
            $request->validate([
                "name" => "required",
                "subject" => "required",
                "message" => "required",
            ]);

            $question = $request->all();

            $save_message = Question::create($question);

            if ($save_message) {
                return response()->json(["message" => "message saved", "data" => $save_message]);
            }
        }
    }


    public function single_product($id)
    {
        $single_product = Product::find($id);

        return response()->json($single_product);
    }


    public function single_blog($id)
    {
        $single_blog = Blog::find($id);

        return response()->json($single_blog);
    }

    public function add_blog(Request $request)
    {
        if ($request->isMethod("POST")) {
            $request->validate([
                "author_name" => "required",
                "title" => "required",
                "blog_details" => "required",
                "blog_image" => "required",

            ]);


            $blog = $request->all();
            $blog_image = $request->file("blog_image")->getClientOriginalName();
            $destination = $request->blog_image->move(("images"), $blog_image);



            $blog["blog_image"] = $destination;

            $save_blog = Blog::create($blog);
            if ($save_blog) {
                return ("blog saved");
            }
        }
        return view("add_blog");
    }

    public function blogs()
    {

        $blogs = Blog::orderBy('id', 'DESC')->get();;
        return response()->json($blogs);
    }



    public function transaction(Request $request)
    {
        if ($request->isMethod("POST")) {
            $request->validate([
                "user_id" => "required",
                "product_id" => "required",
                "product_qty" => "required",
                "product_price" => "required",
                "product_total" => "required",
                "trans_total" => "required",
                "trans_ref" => "required",
                "trans_status" => "required",
            ]);

            $transaction = $request->all();
            $save_trans = Transaction::create($transaction);

            if ($save_trans) {
                return response()->json(["it has been saved" => $save_trans]);
            }
        }
    }

    public function update_status($ref)
    {
        $update = Transaction::where("trans_ref", $ref)->update(["trans_status" => "success"]);
        return response()->json($update);
    }

    public function add_contact(Request $request)
    {       
        if ($request->isMethod("POST")) {

            $validator = Validator::make($request->all(), [
                "user_id" => "required",
                "email_or_phone" => "required",
                "first_name" => "required",
                "last_name" => "required",
                "address" => "required",
                "city" => "required",
                "country" => "required",
                "postal_code" => "required",
            ]);


            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            };
            // $request->validate([
            //     "user_id" => "required",
            //     "email_or_phone" => "required",
            //     "first_name" => "required",
            //     "last_name" => "required",
            //     "address" => "required",
            //     "city" => "required",
            //     "country" => "required",
            //     "postal_code" => "required",
            // ]);

            $contacts = $request->all();
            $save_contact = Contact::create($contacts);

            if ($save_contact) {
                return response()->json($save_contact);
            }
        } 
        
    
    }

    public function update_contact(Request $request)
    {
        if ($request->isMethod("POST")) {
            // $request->validate([
            //     "user_id" => "required",
            //     "email_or_phone" => "required",
            //     "first_name" => "required",
            //     "last_name" => "required",
            //     "address" => "required",
            //     "city" => "required",
            //     "country" => "required",
            //     "postal_code" => "required",
            // ]);


            
            $validator = Validator::make($request->all(), [
                "user_id" => "required",
                "email_or_phone" => "required",
                "first_name" => "required",
                "last_name" => "required",
                "address" => "required",
                "city" => "required",
                "country" => "required",
                "postal_code" => "required",
            ]);


            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            };

            $contact_update = Contact::where("user_id", $request->user_id)->update(["email_or_phone" => $request->email_or_phone, "first_name" => $request->first_name, "last_name" => $request->last_name, "address" => $request->address, "city" => $request->city, "country" => $request->country, "postal_code" => $request->postal_code, "apartment_address" => $request->apartment_address]);

            if ($contact_update) {
                return response()->json($contact_update);
            }
        }
    }


    public function get_contact($user_id)
    {
        $user_contact = Contact::where("user_id", $user_id)->get();
        return response()->json($user_contact);
    }


    public function add_category(Request $request){
        if ($request->isMethod("POST")){
            $request->validate([
                "category" => "required"
            ]);

            $save_category = Category::create($request->all());

            if ($save_category){
                return ("Category saved");
            }
        }

        return view("category");
    }


    public function add_brand(Request $request){

        if ($request->isMethod("POST")){
            $request->validate([
                "brand" => "required|unique:brands"
            ]);

            $save_brand = Brand::create($request->all());

            if ($save_brand){
                return ("Brand saved");
            }
        }

        return view("brand");
    }


    public function filter($value)
    {
        $filtered = Product::orderBy('id', 'DESC')->where("brand", $value)->orWhere("category", $value)->get();
        return response()->json($filtered);
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function brands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }
}
