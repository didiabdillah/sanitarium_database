<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Resource;
use App\Models\Source;
use App\Models\Author;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Resource_link;
use App\Models\Resource_image;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource = Resource::join('categories', 'resources.resource_category_id', '=', 'categories.category_id')
            ->join('sub_categories', 'resources.resource_sub_category_id', '=', 'sub_categories.sub_category_id')
            ->orderBy('resources.created_at', 'desc')->get();

        $view_data = [
            'resource' => $resource,
        ];

        return view('resource.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $source = Source::orderBy('source_label', 'asc')->get();
        $author = Author::orderBy('author_label', 'asc')->get();
        $category = Category::orderBy('category_label', 'asc')->get();
        $sub_category = Sub_Category::orderBy('sub_category_label', 'asc')->get();

        $view_data = [
            'source' => $source,
            'author' => $author,
            'category' => $category,
            'sub_category' => $sub_category,
        ];

        return view('resource.insert', $view_data);
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
                'sub_category'  => 'required',
                'link'  => 'required|max:255',
                'image'  => 'max:60000',
                'desc'  => 'max:60000',
            ]
        );

        $label = htmlspecialchars($request->label);
        $category = htmlspecialchars($request->category);
        $sub_category = htmlspecialchars($request->sub_category);
        $source = htmlspecialchars($request->source);
        $author = htmlspecialchars($request->author);
        $desc = htmlspecialchars($request->desc);
        $link = htmlspecialchars($request->link);
        $image = htmlspecialchars($request->image);

        //check is skema exist in DB
        if (Resource_link::where('resource_link_url', htmlspecialchars($link))->count() > 0) {

            //Flash Message
            // flash_alert(
            //     __('alert.icon_error'), //Icon
            //     'Gagal', //Alert Message 
            //     'Nama Skema Sudah Ada' //Sub Alert Message
            // );

            return redirect()->route('resource');
        }

        $resource_id =  uniqid() . strtotime(now());

        $source = (Source::where('source_id', $source)->first()) ? Source::where('source_id', $source)->first()->source_label : NULL;
        $author = (Author::where('author_id', $author)->first()) ? Author::where('author_id', $author)->first()->author_label : NULL;

        $data = [
            'resource_id' => $resource_id,
            'resource_category_id' => $category,
            'resource_sub_category_id' => $sub_category,
            'resource_source' => $source,
            'resource_author' => $author,
            'resource_label' => $label,
            'resource_desc' => $desc,
        ];

        //Insert Data
        Resource::create($data);

        $data = [
            'resource_link_id' => uniqid() . strtotime(now()),
            'resource_link_resource_id' => $resource_id,
            'resource_link_url' => $link,
        ];

        Resource_link::create($data);

        if ($image) {
            $data = [
                'resource_image_id' => uniqid() . strtotime(now()),
                'resource_image_resource_id' => $resource_id,
                'resource_image_link' => $image,
            ];

            Resource_image::create($data);
        }

        //Flash Message
        // flash_alert(
        //     __('alert.icon_success'), //Icon
        //     'Sukses', //Alert Message 
        //     'Skema Ditambahkan' //Sub Alert Message
        // );

        return redirect()->route('resource_create');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
