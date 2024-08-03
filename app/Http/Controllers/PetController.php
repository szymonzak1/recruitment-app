<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class PetController extends Controller
{
    private $url = 'https://petstore.swagger.io/v2/pet';

    public function index()
    {
        return view('index');
    }

    public function add()
    {
        return view('pet.add');
    }

    public function show(Request $request)
    {
        $data = $this->getPet($request->id);
        if($data===400)
            return back()->with('message','Podane błędne id');
        elseif($data===404)
            return back()->with('message','Takie zwierze nie istnieje');
        else
            return view('pet.show',[
                'pet' => $data,
            ]);

    }

    public function edit(Request $request)
    {
        $data = $this->getPet($request->id);
        if($data===400)
            return back()->with('message','Podane błędne id');
        elseif($data===404)
            return back()->with('message','Takie zwierze nie istnieje');
        else
            return view('pet.edit',[
                'pet' => $data,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|max:64',
            'name' => 'required|string|max:256',
            'category' => 'nullable|string|max:256',
            'tags' => 'nullable|string|max:1024',
            'status' => 'required'
        ]);
        $tags=null;
        if($request->tags)
        {
            $tagsArray = explode(',', $request->tags);
            $tags = array_map(function($tag, $index) {
                return [
                    'id' => $index + 1,
                    'name' => trim($tag)
                ];
            }, $tagsArray, array_keys($tagsArray));
        }
        $response = Http::post($this->url,[
            'id' => (int) $request->input('id'),
            'name' => $request->input('name'),
            'category' => ['id' => 1, 'name' => $request->input('category')],
            'tags' => $tags,
            'status' => $request->input('status')
        ]);
        if($response->status()===200)
            return redirect('/show/'.$request->input('id'));
        elseif($response->status()===405)
            return back()->with('message','Błędne dane');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|max:64',
            'name' => 'required|string|max:256',
            'category' => 'nullable|string|max:256',
            'tags' => 'nullable|string|max:1024',
            'status' => 'required'
        ]);
        $tags=null;
        if($request->tags)
        {
            $tagsArray = explode(',', $request->tags);
            $tags = array_map(function($tag, $index) {
                return [
                    'id' => $index + 1,
                    'name' => trim($tag)
                ];
            }, $tagsArray, array_keys($tagsArray));
        }
        $response = Http::put($this->url,[
            'id' => (int) $request->input('id'),
            'name' => $request->input('name'),
            'category' => ['id' => 1, 'name' => $request->input('category')],
            'tags' => $tags,
            'status' => $request->input('status')
        ]);
        if($response->status()===200)
            return redirect('/show/'.$request->input('id'));
        elseif($response->status()===400)
            return back()->with('message','Podane błędne id');
        elseif($response->status()===404)
            return back()->with('message','Takie zwierze nie istnieje');
        elseif($response->status()===405)
            return back()->with('message','Błędne dane');
    }

    public function delete(Request $request)
    {
        $response = Http::delete($this->url.'/'.$request->id);
        if($response->status()===200)
            return redirect('/')->with('message','Zwierze zostało usinięte');
        elseif($response->status()===400)
            return back()->with('message','Podane błędne id');
        elseif($response->status()===404)
            return back()->with('message','Takie zwierze nie istnieje');
    }

    private function getPet($id)
    {
        $response = Http::get($this->url.'/'.$id);
        if($response->status()===200)
        {
            $data = $response->json();
            if(isset($data['tags']))
            {
                $tagNames = array_map(function($tag) {
                    return $tag['name'];
                }, $data['tags']);
                $tagsString = implode(',', $tagNames);
                $data['tags'] = $tagsString;
            }
            if(isset($data['category']))
                $data['category'] = $data['category']['name'];
            return $data;
        }
        elseif($response->status()===400)
            return 400;
        elseif($response->status()===404)
            return 404;

    }
}
