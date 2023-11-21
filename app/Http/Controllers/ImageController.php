<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Schema\ValidationException;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required',
            ]);
        } catch(ValidationException $e) {
            $errMsg = $e->getMessage();
            $errCode = $e->getCode();
            return response($errMsg,$errCode);
        }
        $imageName = $request->image->store();
        return env('IMAGE_BASE_URI').$imageName;
    }

    public function destroy(Request $request)
    {
        $fileName = basename($request["imagePath"]);

        if(Storage::fileExists($fileName)) {
            $destroyFile = Storage::delete($fileName);
        } else {
            return response()->json(['error' => 'Image not found'], 404);
        }

        return $destroyFile == 1 ?
            response()->json(['message' => 'Image deleted successfully']) :
            response()->json(['error' => 'Failed to delete Image'], 500);
    }
}

