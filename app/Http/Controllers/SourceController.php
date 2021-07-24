<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Source;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $source = Source::orderBy('sources.created_at', 'desc')->get();

        $view_data = [
            'source' => $source,
        ];

        return view('source.index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('source.create');
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
        if (Source::where('source_label', htmlspecialchars($label))->count() > 0) {

            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Source Already Exist' //Sub Alert Message
            );

            return redirect()->route('source_create');
        }

        $source_id =  uniqid() . strtotime(now());

        $data = [
            'source_id' => $source_id,
            'source_label' => $label,
            'source_link' => $link,
        ];

        //Insert Data
        Source::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Source Added' //Sub Alert Message
        );

        return redirect()->route('source');
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
        $source = Source::where('source_id', $id)->first();

        $view_data = [
            'source' => $source,
        ];

        return view('source.edit', $view_data);
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
        if (Source::where('source_label', htmlspecialchars($label))->where('source_id', '!=', $id)->count() > 0) {

            // Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Source Already Exist' //Sub Alert Message
            );

            return redirect()->route('source_edit', $id);
        }

        $data = [
            'source_label' => $label,
            'source_link' => $link,
        ];

        //Update Data
        Source::where('source_id', $id)->update($data);

        // Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Source Updated' //Sub Alert Message
        );

        return redirect()->route('source');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Source::destroy($id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Source Deleted' //Sub Alert Message
        );

        return redirect()->route('source');
    }
}
