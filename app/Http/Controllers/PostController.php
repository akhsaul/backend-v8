<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    private static $categorys = array('Hewan', 'Benda', 'Tumbuhan', 'Buah');

    public function getByCategory(Request $request, $category)
    {
        if (in_array($category, self::$categorys)) {
            try {
                $post = Data::where('category', $category)->get();
            } catch (Exception $e) {
                abort(500);
            }
            return view('index')->with('posts', $post)->with('category', $category);
        } else {
            abort(404);
        }
    }

    public function make($category)
    {
        if (in_array($category, self::$categorys)) {
            return view('create')->with('category', $category);
        } else {
            abort(404);
        }
    }

    public function store(Request $request, $category)
    {
        if (in_array($category, self::$categorys)) {
            if ($request->hasFile("image") && $request->hasFile('sound')) {
                $image = $request->file("image");
                $sound = $request->file('sound');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $soundName = time() . '_' . $sound->getClientOriginalName();
                $image->move(\public_path("images/"), $imageName);
                $sound->move(\public_path("sounds/"), $soundName);

                try {
                    Data::create([
                        "name" => $request->name,
                        "title" => $request->title,
                        "image" => $imageName,
                        "sound" => $soundName,
                        "category" => $category,
                    ]);
                } catch (Exception $e) {
                    abort(500);
                }
                return redirect('/data/' . $category);
            } else {
                abort(400);
            }
        } else {
            abort(404);
        }
    }

    public function edit($id)
    {
        $posts = Data::findOrFail($id);
        return view('edit')->with('posts', $posts);
    }

    public function update(Request $request, $id)
    {
        $post = Data::findOrFail($id);

        if ($request->hasFile("image") && $request->hasFile('sound')) {

            $image = $request->file("image");
            $sound = $request->file('sound');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $soundName = time() . '_' . $sound->getClientOriginalName();
            $image->move(\public_path("images/"), $imageName);
            $sound->move(\public_path("sounds/"), $soundName);

            if (File::exists("images/" . $post->image)) {
                File::delete("images/" . $post->image);
            }
            if (File::exists("sounds/" . $post->sound)) {
                File::delete("sounds/" . $post->sound);
            }

            try {
                Data::where('id', $id)->update([
                    "name" => $request->name,
                    "title" => $request->title,
                    "image" => $imageName,
                    "sound" => $soundName,
                    "category" => $post->category,
                ]);
            } catch (Exception $e) {
                abort(500);
            }

            return redirect('/data/'.$post->category);
        } else{
            abort(400);
        }
    }

    public function destroy($id)
    {
        $posts = Data::findOrFail($id);

        if (File::exists("images/" . $posts->image)) {
            File::delete("images/" . $posts->image);
        }
        if (File::exists("sounds/" . $posts->sound)) {
            File::delete("sounds/" . $posts->sound);
        }
        $posts->delete();
        return back();
    }
}
