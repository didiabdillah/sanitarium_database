<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sub_category;
use App\Models\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_category = Sub_category::join('categories', 'sub_categories.sub_category_category_id', '=', 'categories.category_id')
            ->orderBy('sub_categories.created_at', 'desc')->get();

        $view_data = [
            'sub_category' => $sub_category,
        ];

        return view('subcategory.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('categories.category_label', 'asc')->get();

        $view_data = [
            'category' => $category,
        ];

        return view('subcategory.create', $view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'category'  => 'required',
            ]
        );

        $label = htmlspecialchars($request->label);
        $category = htmlspecialchars($request->category);

        //check is sub category exist in DB
        if (Sub_category::where('sub_category_label', htmlspecialchars($label))->where('sub_category_category_id', htmlspecialchars($category))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Sub Category Already Exist' //Sub Alert Message
            );

            return redirect()->route('sub_category_create');
        }

        $sub_category_id =  uniqid() . strtotime(now());

        $data = [
            'sub_category_id' => $sub_category_id,
            'sub_category_category_id' => $category,
            'sub_category_label' => $label,
        ];

        //Insert Data
        Sub_category::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Sub Category Added' //Sub Alert Message
        );

        return redirect()->route('sub_category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category = Sub_category::where('sub_category_id', $id)->first();
        $category = Category::orderBy('categories.category_label', 'asc')->get();

        $view_data = [
            'sub_category' => $sub_category,
            'category' => $category,
        ];

        return view('subcategory.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'label'  => 'required|max:255',
                'category'  => 'required',
            ]
        );

        $label = htmlspecialchars($request->label);
        $category = htmlspecialchars($request->category);

        //check is skema exist in DB
        if (Sub_category::where('sub_category_label', htmlspecialchars($label))->where('sub_category_id', '!=', $id)->where('sub_category_category_id', htmlspecialchars($category))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Sub Category Already Exist' //Sub Alert Message
            );

            return redirect()->route('sub_category_edit', $id);
        }

        $data = [
            'sub_category_label' => $label,
            'sub_category_category_id' => $category,
        ];

        //Update Data
        Sub_category::where('sub_category_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Sub Category Updated' //Sub Alert Message
        );

        return redirect()->route('sub_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sub_category::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Sub Category Deleted' //Sub Alert Message
        );

        return redirect()->route('sub_category');
    }
}
