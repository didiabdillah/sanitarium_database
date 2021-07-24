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
            ->leftjoin('sources', 'resources.resource_source_id', '=', 'sources.source_id')
            ->leftjoin('authors', 'resources.resource_author_id', '=', 'authors.author_id')
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
        $sub_category = Category::orderBy('category_label', 'asc')->get();

        $view_data = [
            'source' => $source,
            'author' => $author,
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
                'sub_category'  => 'required',
                'link'  => 'required|max:60000',
                'image'  => 'max:60000',
                'desc'  => 'max:60000',
            ]
        );

        $label = htmlspecialchars($request->label);
        $sub_category = htmlspecialchars($request->sub_category);
        $source = htmlspecialchars($request->source);
        $author = htmlspecialchars($request->author);
        $desc = htmlspecialchars($request->desc);
        $link = htmlspecialchars($request->link);
        $image = htmlspecialchars($request->image);

        $category = Category::whereHas('sub_category', function ($query) use ($sub_category) {
            $query->where('sub_category_id', $sub_category);
        })->first()->category_id;

        $links = str_replace(' ', '', explode(',', $link));
        $images = str_replace(' ', '', explode(',', $image));

        //check is skema exist in DB
        foreach ($links as $row) {
            if (Resource_link::where('resource_link_url', htmlspecialchars($row))->count() > 0) {

                //Flash Message
                // flash_alert(
                //     __('alert.icon_error'), //Icon
                //     'Gagal', //Alert Message 
                //     'Nama Skema Sudah Ada' //Sub Alert Message
                // );

                return redirect()->route('resource');
            }
        }

        $resource_id =  uniqid() . strtotime(now());

        $data = [
            'resource_id' => $resource_id,
            'resource_category_id' => $category,
            'resource_sub_category_id' => $sub_category,
            'resource_source_id' => $source,
            'resource_author_id' => $author,
            'resource_label' => $label,
            'resource_desc' => $desc,
        ];

        //Insert Data
        Resource::create($data);

        foreach ($links as $row) {
            if ($row != "") {
                $data = [
                    'resource_link_id' => uniqid() . strtotime(now()),
                    'resource_link_resource_id' => $resource_id,
                    'resource_link_url' => $row,
                ];

                Resource_link::create($data);
            }
        }

        if ($images[0] != "") {
            foreach ($images as $row) {
                if ($row != "") {
                    $data = [
                        'resource_image_id' => uniqid() . strtotime(now()),
                        'resource_image_resource_id' => $resource_id,
                        'resource_image_link' => $row,
                    ];

                    Resource_image::create($data);
                }
            }
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
        $source = Source::orderBy('source_label', 'asc')->get();
        $author = Author::orderBy('author_label', 'asc')->get();
        $sub_category = Category::orderBy('category_label', 'asc')->get();
        $resource = Resource::find($id);

        $view_data = [
            'resource' => $resource,
            'source' => $source,
            'author' => $author,
            'sub_category' => $sub_category,
        ];

        return view('resource.edit', $view_data);
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
                'sub_category'  => 'required',
                'link'  => 'required|max:60000',
                'image'  => 'max:60000',
                'desc'  => 'max:60000',
            ]
        );

        $label = htmlspecialchars($request->label);
        $sub_category = htmlspecialchars($request->sub_category);
        $source = htmlspecialchars($request->source);
        $author = htmlspecialchars($request->author);
        $desc = htmlspecialchars($request->desc);

        $link = htmlspecialchars($request->link);
        $image = htmlspecialchars($request->image);


        $links = str_replace(' ', '', explode(',', $link));
        $images = str_replace(' ', '', explode(',', $image));

        //check is skema exist in DB
        foreach ($links as $row) {
            if (Resource_link::where('resource_link_url', htmlspecialchars($row))->where('resource_link_resource_id', '!=', $id)->count() > 0) {

                //Flash Message
                // flash_alert(
                //     __('alert.icon_error'), //Icon
                //     'Gagal', //Alert Message 
                //     'Nama Skema Sudah Ada' //Sub Alert Message
                // );

                return redirect()->route('resource');
            }
        }

        $category = Category::whereHas('sub_category', function ($query) use ($sub_category) {
            $query->where('sub_category_id', $sub_category);
        })->first()->category_id;

        $data = [
            'resource_category_id' => $category,
            'resource_sub_category_id' => $sub_category,
            'resource_source_id' => $source,
            'resource_author_id' => $author,
            'resource_label' => $label,
            'resource_desc' => $desc,
        ];

        //Update Data
        Resource::where('resource_id', $id)->update($data);

        // Update Link
        Resource_link::where('resource_link_resource_id', $id)->delete();
        foreach ($links as $row) {
            if ($row != "") {
                $data = [
                    'resource_link_id' => uniqid() . strtotime(now()),
                    'resource_link_resource_id' => $id,
                    'resource_link_url' => $row,
                ];

                Resource_link::create($data);
            }
        }

        // Update Image
        Resource_image::where('resource_image_resource_id', $id)->delete();
        if ($images[0] != "") {
            foreach ($images as $row) {
                if ($row != "") {
                    $data = [
                        'resource_image_id' => uniqid() . strtotime(now()),
                        'resource_image_resource_id' => $id,
                        'resource_image_link' => $row,
                    ];

                    Resource_image::create($data);
                }
            }
        }

        //Flash Message
        // flash_alert(
        //     __('alert.icon_success'), //Icon
        //     'Sukses', //Alert Message 
        //     'Skema Ditambahkan' //Sub Alert Message
        // );

        return redirect()->route('resource');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Resource::destroy($id);

        return redirect()->route('resource');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status_edit($id)
    {
        $resource = Resource::find($id);

        $view_data = [
            'resource' => $resource,
        ];

        return view('resource.status_edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status_update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'status'  => 'required',
            ]
        );

        $status = htmlspecialchars($request->status);

        $data = [
            'resource_status' => $status,
        ];

        //Update Data
        Resource::where('resource_id', $id)->update($data);

        //Flash Message
        // flash_alert(
        //     __('alert.icon_success'), //Icon
        //     'Sukses', //Alert Message 
        //     'Skema Ditambahkan' //Sub Alert Message
        // );

        return redirect()->route('resource');
    }
}
