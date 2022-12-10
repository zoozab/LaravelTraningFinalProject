<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Wallet;
use App\Models\ProductsForSale;
use App\Models\MultiImage;
use App\Models\Comments;
use App\Models\Products;
use App\Models\SiteMultiImage;
use App\Models\MasterHeadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;


class usercontroller extends Controller
{
    //
    public function homeUser()
    {
        $cat = Catagory::all();
        $catagory_all = $cat->sortByDesc('id')->toQuery()->paginate(12);
        $multi_images = MasterHeadImage::all();
        return view('main.indexUser', compact('catagory_all', 'multi_images'));
    }
    public function userProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.userProfile', compact('adminData'));
    }
    public function userProfileEdit()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.userProfileEdit', compact('adminData'));
    }
    public function userProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $Data = User::find($id);
        $Data->name = $request->name;
        $Data->email = $request->email;

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('ymdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images/'), $filename);
            $Data['profile_image'] = $filename;
        }
        $Data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('userProfile')->with($notification);
    }

    public function UserChangePassword()
    {




        return view('admin.UserChangePassword');
    }
    public function UserUpdatePassword(Request $request)
    {

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required| same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();
            session()->flash('message', 'Password Updated Successfully ');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old Password is not Match ');
            return redirect()->back();
        }
    }

    public function userAllProducts()
    {

        $user_id = Auth::user()->id;
        $userAllProducts = Products::where('user_id', $user_id)->paginate(20);



        return view('admin.userAllProducts', compact('userAllProducts'));
    }

    public function userEditProduct($id)
    {
        $catagory = Catagory::all();
        $user = User::all();
        $userAllProduct = Products::findOrFail($id);

        $multi_images = MultiImage::where('product_id', $id)->get();


        return view('admin.userEditProduct')->with(compact('catagory', 'user', 'userAllProduct', 'multi_images'));
    }

    public function userProductUpdate(Request $request)
    {
        $product_id = $request->id;


        Products::FindOrFail($product_id)->update([
            'product_name' => $request->productName,
            'product_price' => $request->productPrice,
            'product_description' => $request->productDescription,
            'catagory_id' => $request->catagory_id,

        ]);


        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            foreach ($image as $multi_image) {
                $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
                Image::make($multi_image)->resize(500, 600)->save('upload/user_images/' . $name_gen);
                $save_url = 'upload/user_images/' . $name_gen;

                MultiImage::insert([
                    'multi_image' => $save_url,
                    'product_id' => $product_id
                ]);
            }
        }

        $notification = array(
            'message' => 'Product Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('userAllProducts')->with($notification);
    }

    public function addProduct()
    {
        $catagory = Catagory::all();




        return view('admin.userAddProduct', compact('catagory'));
    }

    public function productStore(Request $request)
    {
        $validateData = $request->validate([
            'catagoryName' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productDescription' => 'required',
            'multi_image' => 'required'
        ]);
        $catagory = Catagory::all();
        $user = User::all();
        $user_id = Auth::user()->id;

        $p =  Products::insertGetId([
            'product_name' => $request->productName,
            'product_price' => $request->productPrice,
            'product_description' => $request->productDescription,
            'user_id' => $user_id,
            'catagory_id' => $request->catagoryName,

        ]);



        $image = $request->file('multi_image');
        foreach ($image as $multi_image) {
            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(500, 600)->save('upload/user_images/' . $name_gen);
            $save_url = 'upload/user_images/' . $name_gen;

            MultiImage::insert([
                'multi_image' => $save_url,
                'product_id' => $p
            ]);
        }

        $notification = array(
            'message' => 'Product Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect('userAllProducts')->with($notification);
    }
    public function multiImageDelete($id)
    {

        $multi = MultiIMage::FindOrFail($id);
        $img = $multi->multi_image;
        unlink($img);
        MultiImage::FindOrfail($id)->delete();

        return redirect()->back();
    }
    public function userProductImages($id)
    {
        $multi_images =  MultiImage::where('product_id', $id)->get();

        return view('admin.userProductImages', compact('multi_images'));
    }
    public function deleteProduct($id)
    {
        $multi = MultiIMage::where('product_id', $id);
        $multi->delete();

        $product = Products::FindOrFail($id);
        $product->delete();


        $notification = array(
            'message' => 'Product Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function sellProduct(Request $request)
    {
        $id = $request->pid;
        $p = Products::FindOrFail($id)->get();



        $data = [
            'salesperson_id' => $request->userId,
            'productPrevious_id' => $request->pid,
            'catagory_id' => $request->catagory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description
        ];

        $p_id =  ProductsForSale::insertGetId($data);


        $multi_images =  MultiImage::where('product_id', $id)->get();
        foreach ($multi_images as $multi) {
            SiteMultiImage::insert([
                'multi_image' => $multi->multi_image,
                'product_id' => $p_id
            ]);
        }
        $del = Products::find($request->pid);
        $del->delete();



        $notification = array(
            'message' => 'Product Added To Sell List Successfully.',
            'alert-type' => 'success'
        );
        return redirect('userAllProducts')->with($notification);
    }

    public function userWallet()
    {
        $user_id = Auth::user()->id;
        $userWallet =  Wallet::where('user_id', $user_id)->get();
        $userWalletSum = $userWallet->sum('amount');


        return view('admin.userWallet', compact('userWalletSum'));
    }
    public function walletRaise(Request $request)
    {
        $validateData = $request->validate([
            'amountToRaise' => 'required|numeric|gt:0'
        ]);
        $user_id = Auth::user()->id;

        Wallet::insert([
            'amount' => $request->amountToRaise,
            'user_id' => $user_id
        ]);

        $notification = array(
            'message' => 'Amount Raised Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function userallProductsForSell($id)
    {
        $productWithCatagory = productsForSale::where('catagory_id', $id)->paginate(12);

        $multi_image = SiteMultiImage::all();


        return view('main.userallProductsForSell', compact('productWithCatagory', 'multi_image'));
    }
    public function userProductShowAllComments($id)
    {
        $comments = Comments::where('product_id', $id)->paginate(10);
        $product_id = ProductsForSale::where('id', $id)->get();
        return view('main.userProductShowAllComments', compact('comments', 'product_id'));
    }
    public function userpostComment(Request $request)
    {
        $validateData = $request->validate([
            'msg' => 'required'
        ]);

        Comments::insert([
            'comment' => $request->msg,
            'product_id' => $request->id
        ]);

        $notification = array(
            'message' => 'Comment Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function buyProduct(Request $request)
    {
        $user_id = Auth::user()->id;
        $userWallet =  Wallet::where('user_id', $user_id)->get();
        $userWalletSum = $userWallet->sum('amount');
        $price = $request->product_price;
        if ($price < $userWalletSum) {
            $p_id = $request->id;
            ProductsForSale::FindOrFail($p_id);

            $data = [
                'catagory_id' => $request->catagory_id,
                'user_id' => $user_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description
            ];
            $id = Products::insertGetId($data);


            $multi_images = SiteMultiImage::where('product_id', $p_id)->get();
            foreach ($multi_images as $multi) {
                MultiImage::insert([
                    'multi_image' => $multi->multi_image,
                    'product_id' => $id
                ]);
            }
            $del = ProductsForSale::find($request->id);
            $del->delete();



            Wallet::insert([
                'amount' => -$price,
                'user_id' => $user_id
            ]);

            Wallet::insert([
                'amount' => $price,
                'user_id' => $request->salesperson_id
            ]);

            $notification = array(
                'message' => 'Product Purchase Successfully.',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'You Dont Have enough Money to Buy this Product',
                'alert-type' => 'danger'
            );
        }
        return redirect()->back()->with($notification);
    }
    public function userallProductsForSellNoCat()
    {

        $p = productsForSale::all();
        $product = $p->sortByDesc('id')->toQuery()->paginate(12);

        $multi_image = SiteMultiImage::all();
        return view('main.userallProductsForSellNoCat', compact('product', 'multi_image'));
    }
}
