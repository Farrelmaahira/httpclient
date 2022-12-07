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
            $result = $response->json();
        }
        return redirect()->route('home');
    }

    public function delete($id)
    {
        $data = Http::delete('http://127.0.0.1:8003/api/v1/book/' . $id)->collect();
        return redirect()->route('home');
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
        // $this->validate($request, [
        //     'title' => ['required'],
        //     'author' => ['required'],
        //     'description' => ['required'],
        //     'released' => ['required'],
        //     'image' => 'image'
        // ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $response = Http::attach('image', file_get_contents($image), $imageName)->put('http://127.0.0.1:8003/api/v1/book/' . $id, [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'released' => $request->released,
            ]);
            $result = $response->json();
        } else {
            $response = Http::put('http://127.0.0.1:8003/api/v1/book/' . $id, [
                'title' => $request->title,
                'author' => $request->author,
                'description' => $request->description,
                'released' => $request->released,
            ]);
            $result = $response->json();


            dd($result);
            return redirect()->route('home');
        }
    }
}
