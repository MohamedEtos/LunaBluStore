<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {

        $Categorylist = category::get();

        return view('admin.Category.Categorylist',[
            'Categorylist' => $Categorylist,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        dd($request->all());
        $request->validate([
            'name'=>'required|string',
            'catimg'=>'required|mimes:jpeg,png,jpg,gif,webp|max:51200',
            'meta_title'=>'required|string',
            'meta_description'=>'required|string',
        ],[
            'catimg.required'=>'يرجي اضافه صور',
            'catimg.mimes'=>'الامتدادات المسموح بها فقط (jpeg,png,jpg,gif,webp)',
            'catimg.max'=>'يجب الا يكون حجم الصوره اكبر من 50 MB',
            'name.required'=>'الاسم مطلوب',
            'meta_title.required'=>'الميتا مطلوبه',
            'meta_description.required'=>'الوصف مطلوب',
        ]);

        DB::transaction(function () use ($request) {

            if($request->hasFile('catimg')){
                $image  = ImageManagerStatic::make($request->file('catimg'))->encode('webp')->resize(566,700);
                $imageName = Str::random().'.webp';
                $image->save(public_path('storage/images/catimg'. $imageName));
                $main_image = 'storage/images/catimg'. $imageName;
            }else{
                $main_image = '';
            };

            $Category = category::create([
                "name" => $request->name,
                "catimg" =>$main_image,
                "meta_title" => $request->meta_title,
                "meta_description" => $request->meta_description,
            ]);

        });

        return redirect()->back()->with(['success'=>'اضافه قسم']);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
