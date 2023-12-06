<?php

namespace App\Http\Controllers;

use App\Models\EmbedLink;
use Illuminate\Http\Request;

class EmbedLinkController extends Controller
{
    public function update(Request $request) {
        $data = EmbedLink::firstOrFail();

        if($data) {
            $data->link = "https://www.youtube.com/embed/".basename($request->link);
        }
        $data->save();

        return redirect()->back();
    }
}
