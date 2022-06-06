<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!userCan('slider.store')){
            abort('403');
        }
        $request->validate([
            'title' => 'required|string|max:40',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|max:1024',
        ]);

        $slider = Slider::create($request->except('csrf_token'));

        if($request->hasFile('image')){
            $url = updateImage($request->file('image'), 'sliders');
            $slider->image = $url;
            $slider->save();
        }

        if($slider){
            flashSuccess('Slider added successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliderData = Slider::findOrFail($id);
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliderData', 'sliders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!userCan('slider.update')){
            abort('403');
        }

        $slider = Slider::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:40',
            'description' => 'nullable|string|max:255',
        ]);

        $slider->image !== null ? $request->validate(['image' => 'nullable|image|max:1024']) : $request->validate(['image' => 'required|image|max:1024']);

        $slider->title = $request->title;
        $slider->description = $request->description;

        if($request->hasFile('image')){
            deleteImage($slider->image);
            $url = updateImage($request->file('image'), 'sliders');
            $slider->image = $url;
        }

        $slider->save();
        if($slider){
            flashSuccess('Slider Updated successfully!');
            return back();
        }

        flashError('Something went wrong...');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!userCan('slider.delete')){
            flashError('Your Don\'t Have Permission to Deleted!');
            return back();
        }

        $slider = Slider::findOrFail($id);

        if($slider->image !== null){
            deleteImage($slider->image);
        }

        $slider->delete();
        flashSuccess('Slider Deleted successfully!');
        return back();
    }

    public function status_change(Request $request)
    {
        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status;
        $slider->save();

        if ($request->status == 1) {
            return responseSuccess('Slider Activated Successfully');
        } else {
            return responseSuccess('Slider Inactivated Successfully');
        }
    }
}
