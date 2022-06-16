<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Exception;
use Illuminate\Support\Facades\File;

class DataController extends Controller
{
    private static $categorys = array('Hewan', 'Benda', 'Tumbuhan', 'Buah');
    public function getByCategory($category)
    {

        if (in_array($category, self::$categorys)) {
            try {
                $data = Data::where('category', $category)->get();
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'msg' => $e->getMessage()
                ], 500);
            }

            if (count($data) > 0) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Data dengan category ' . $category,
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Data Kosong',
                    'data' => $data
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Category ' . $category . ' tidak di temukan'
            ], 404);
        }
    }

    public function getImage($imageName)
    {
        $file = \public_path("images/") . $imageName;
        if (File::exists($file)) {
            return response()->download($file, $imageName, [
                'Cache-Control' => 'max-age=86400',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Image ' . $imageName . ' tidak di temukan'
            ], 404);
        }
    }

    public function getSound($soundName)
    {
        $file = \public_path("sounds/") . $soundName;
        if (File::exists($file)) {
            return response()->download($file, $soundName, [
                'Cache-Control' => 'max-age=86400',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Sound ' . $soundName . ' tidak di temukan'
            ], 404);
        }
    }
}
