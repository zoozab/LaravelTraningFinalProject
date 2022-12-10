<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Products;
use App\Models\MultiImage;
use App\Models\Catagory;
use App\Models\Comments;
use App\Models\Wallet;
use App\Models\ProductsForSale;
use App\Models\SiteMultiImage;
use App\Models\MasterHeadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;

use Illuminate\Support\Facades\Hash;


class admincontroller extends Controller
{
    //
    public function homeAdmin()
    {
        $cat = Catagory::all();
        $catagory_all = $cat->sortByDesc('id')->toQuery()->paginate(12);

        $multi_images = MasterHeadImage::all();

        return view('main.indexAdmin', compact('catagory_all', 'multi_images'));
    }
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.adminProfile', compact('adminData'));
    }
    public function adminProfileEdit()
    {
        $id = Auth::user()->id;
        $adminDataEdit = User::find($id);
        return view('admin.adminProfileEdit', compact('adminDataEdit'));
    }
    public function adminProfileUpdate(Request $request)
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
            'message' => 'Admin Profile Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('adminProfile')->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.AdminChangePassword');
    }

    public function AdminUpdatePassword(Request $request)
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

    public function userManage()
    {
        $users = User::all()->except(Auth::id())->sortByDesc('id')->toQuery()->paginate(20);

        return view('admin.userManage', compact('users'));
    }

    public function userDelete($id)
    {

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('userManage')->with($notification);
    }

    public function allCatagory()
    {
        $catagory_all = Catagory::all();
        return view('admin.allCatagory', compact('catagory_all'));
    }

    public function productsForSale()
    {
        $products = ProductsForSale::all()->sortByDesc('id')->toQuery()->paginate(20);
        return view('admin.allProducts', compact('products'));
    }

    public function addCatagory(Request $request)
    {

        $validateData = $request->validate([
            'catagory_name' => 'required',
            'catagory_image' => 'required'

        ]);

        $file = $request->file('catagory_image');
        $filename = date('ymdHi') . $file->getClientOriginalName();
        $file->move(public_path('upload/user_images/'), $filename);
        $catagory['catagory_image'] = $filename;

        Catagory::insert([
            'catagory_name' => $request->catagory_name,
            'catagory_image' => $filename

        ]);



        $notification = array(
            'message' => 'Catagory Added Successfully.',
            'alert-type' => 'success'
        );

        return view('admin.addCatagory')->with($notification);
    }

    public function addCat()
    {
        return view('admin.addCatagory');
    }

    public function deleteCatagory($id)
    {

        Catagory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Catagory Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('allCatagory')->with($notification);
    }

    public function editCatagory(Request $request, $id)
    {

        $cat = catagory::find($id);

        return view('admin.editCatagory', compact('cat'));
    }

    public function updateCatagory(Request $request)
    {
        $cat_id = $request->id;
        $catagory = catagory::FindOrFail($cat_id);
        $catagory->catagory_name = $request->catagory_name;

        if ($request->file('catagory_image')) {
            $file = $request->file('catagory_image');
            $filename = date('ymdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $filename);
            $catagory['catagory_image'] = $filename;
        }
        $catagory->save();



        $notification = array(
            'message' => 'Catagory Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('allCatagory')->with($notification);
    }

    public function deleteProducts($id)
    {

        Products::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('allProducts')->with($notification);
    }
    public function adminWallet()
    {
        $user_id = Auth::user()->id;
        $userWallet =  Wallet::where('user_id', $user_id)->get();
        $userWalletSum = $userWallet->sum('amount');


        return view('admin.adminWallet', compact('userWalletSum'));
    }
    public function adminProductImages($id)
    {


        $multi_image = SiteMultiImage::where('product_id', $id)->get();


        return view('admin.adminProductImages', compact('multi_image'));
    }
    public function rejectProduct(Request $request)
    {
        $id = $request->id;
        $p = productsForSale::FindOrFail($id)->get();



        $data = [
            'user_id' => $request->salesperson_id,
            'catagory_id' => $request->catagory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description
        ];

        $p_id =  Products::insertGetId($data);


        $multi_images =  SiteMultiImage::where('product_id', $id)->get();
        foreach ($multi_images as $multi) {
            MultiImage::insert([
                'multi_image' => $multi->multi_image,
                'product_id' => $p_id
            ]);
        }

        $del = productsForSale::find($id);
        $del->delete();





        $notification = array(
            'message' => 'Product Added To Sell List Successfully.',
            'alert-type' => 'success'
        );
        return redirect('productsForSale')->with($notification);
    }
    public function allProductsForSell($id)
    {
        $productWithCatagory = productsForSale::where('catagory_id', $id)->paginate(12);
        $multi_image = SiteMultiImage::all();

        return view('main.allProductsForSell', compact('productWithCatagory', 'multi_image'));
    }

    public function adminallProductsForSell($id)
    {
        $productWithCatagory = productsForSale::where('catagory_id', $id)->paginate(12);

        // foreach ($productWithCatagory as $item) {
        //     $multi_image = SiteMultiImage::where('product_id', $item->id)->get();
        // }
        $multi_image = SiteMultiImage::all();
        return view('main.adminallProductsForSell', compact('productWithCatagory', 'multi_image'));
    }
    public function ProductShowAllComments($id)
    {
        $comments = Comments::where('product_id', $id)->paginate(10);
        $product_id = ProductsForSale::where('id', $id)->get();
        return view('main.ProductShowAllComments', compact('comments', 'product_id'));
    }
    public function postComment(Request $request)
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
    public function adminCommentsShow($id)
    {
        $comments = Comments::where('product_id', $id)->paginate(20);
        return view('admin.adminCommentsShow', compact('comments'));
    }
    public function deleteComment($id)
    {
        $cm = Comments::Find($id);
        $cm->delete();
        $notification = array(
            'message' => 'Comment Deleted Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function adminallProductsForSellNoCat()
    {
        $p = productsForSale::all();
        $product = $p->sortByDesc('id')->toQuery()->paginate(12);

        $multi_image = SiteMultiImage::all();
        return view('main.adminallProductsForSellNoCat', compact('product', 'multi_image'));
    }
    public function allProductsForSellNoCat()
    {
        $p = productsForSale::all();
        $product = $p->sortByDesc('id')->toQuery()->paginate(12);

        $multi_image = SiteMultiImage::all();
        return view('main.allProductsForSellNoCat', compact('product', 'multi_image'));
    }
}
