<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8003/api/v1/book')->collect();
        $no = 1;
        // return response()->json($response);
        return view('home', compact('response', 'no'));
    }

    public function input(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'author' => ['required'],
            'description' => ['required'],
            'released' => ['required'],
            'image' => ['image']
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $response = Http::attach('image', file_get_contents($image), $imageName)->post('http://127.0.0.1:8003/api/v1/book/', [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'released' => $request->released,
            ]);
        }
        return back()->with('message', 'New data has been added');
    }

    public function delete($id)
    {
        $response = Http::delete('http://127.0.0.1:8003/api/v1/book/' . $id)->collect();
        return back()->with('message', 'data has been delete');
    }

    public function edit($id)
    {
        $res = Http::get('http://127.0.0.1:8003/api/v1/book/' . $id)->collect()->get('data');
        return view('edit')->with([
            'res' => $res
        ]);
    }

    public function update(Request $request, $id)
    {
       if(!$request->hasFile('image'))
       {
            $response = Http::acceptJson()->put('http://127.0.0.1:8003/api/v1/book/' . $id, [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'released' => $request->released
            ]);
       } elseif ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $response = Http::acceptJson()->attach('image', file_get_contents($image), $imageName)->post('http://127.0.0.1:8003/api/v1/book/'.$id, [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'released' => $request->released,
                '_method' => 'PUT'
            ]);
       }
        if ($response->clientError()) {
         
            return back()->with('message', $response->json()['message']);
        }
        if ($response->serverError()) {
            return back()->with('message', 'server error');
        }
        return redirect()->route('home');
    }
}

//->attach('image', file_get_contents($image), $imageName)