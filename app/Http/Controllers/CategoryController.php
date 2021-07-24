<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('categories.created_at', 'desc')->get();

        $view_data = [
            'category' => $category,
        ];

        return view('category.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            ]
        );

        $label = htmlspecialchars($request->label);

        //check is skema exist in DB
        if (Category::where('category_label', htmlspecialchars($label))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Category Already Exist' //Sub Alert Message
            );

            return redirect()->route('category_create');
        }

        $category_id =  uniqid() . strtotime(now());

        $data = [
            'category_id' => $category_id,
            'category_label' => $label,
        ];

        //Insert Data
        Category::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Category Added' //Sub Alert Message
        );

        return redirect()->route('category');
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
        $category = Category::where('category_id', $id)->first();

        $view_data = [
            'category' => $category,
        ];

        return view('category.edit', $view_data);
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
            ]
        );

        $label = htmlspecialchars($request->label);

        //check is skema exist in DB
        if (Category::where('category_label', htmlspecialchars($label))->where('category_id', '!=', $id)->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Category Already Exist' //Sub Alert Message
            );

            return redirect()->route('category_edit', $id);
        }

        $data = [
            'category_label' => $label,
        ];

        //Update Data
        Category::where('category_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Category Updated' //Sub Alert Message
        );

        return redirect()->route('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Category Deleted' //Sub Alert Message
        );

        return redirect()->route('category');
    }
}
