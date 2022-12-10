<?php

namespace App\Http\Controllers;

use App\Models\MasterHeadImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class MasterHeadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function masterheadimage()
    {
        $multi_images =  MasterHeadImage::all();
        return view('admin.masterheadimage', compact('multi_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMasterHead(Request $request)
    {
        $validateData = $request->validate([
            'multi_image' => 'required'
        ]);

        $image = $request->file('multi_image');
        foreach ($image as $multi_image) {
            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(500, 600)->save('upload/user_images/' . $name_gen);
            $save_url = 'upload/user_images/' . $name_gen;

            MasterHeadImage::insert([
                'multi_image' => $save_url
            ]);
        }




        $notification = array(
            'message' => 'Image Added Successfully.',
            'alert-type' => 'success'
        );
        return redirect('masterheadimage')->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterHeadImage  $masterHeadImage
     * @return \Illuminate\Http\Response
     */
    public function show(MasterHeadImage $masterHeadImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterHeadImage  $masterHeadImage
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterHeadImage $masterHeadImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterHeadImage  $masterHeadImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterHeadImage $masterHeadImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterHeadImage  $masterHeadImage
     * @return \Illuminate\Http\Response
     */

    public function deletemasterhead($id)
    {

        $multi = masterheadimage::FindOrFail($id);
        $img = $multi->multi_image;
        unlink($img);
        masterheadimage::FindOrfail($id)->delete();


        $notification = array(
            'message' => 'Image Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
