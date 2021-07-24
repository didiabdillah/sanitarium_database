<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Author::orderBy('authors.created_at', 'desc')->get();

        $view_data = [
            'author' => $author,
        ];

        return view('author.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
                'link'  => 'max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $link = htmlspecialchars($request->link);

        //check is skema exist in DB
        if (Author::where('author_label', htmlspecialchars($label))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Author Already Exist' //Sub Alert Message
            );

            return redirect()->route('author_create');
        }

        $author_id =  uniqid() . strtotime(now());

        $data = [
            'author_id' => $author_id,
            'author_label' => $label,
            'author_link' => $link,
        ];

        //Insert Data
        Author::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Author Added' //Sub Alert Message
        );

        return redirect()->route('author');
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
        $author = Author::where('author_id', $id)->first();

        $view_data = [
            'author' => $author,
        ];

        return view('author.edit', $view_data);
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
                'link'  => 'max:255',
            ]
        );

        $label = htmlspecialchars($request->label);
        $link = htmlspecialchars($request->link);

        //check is skema exist in DB
        if (Author::where('author_label', htmlspecialchars($label))->where('author_id', '!=', $id)->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Author Already Exist' //Sub Alert Message
            );

            return redirect()->route('author_edit', $id);
        }

        $data = [
            'author_label' => $label,
            'author_link' => $link,
        ];

        //Update Data
        Author::where('author_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Author Updated' //Sub Alert Message
        );

        return redirect()->route('author');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Author Deleted' //Sub Alert Message
        );

        return redirect()->route('author');
    }
}
