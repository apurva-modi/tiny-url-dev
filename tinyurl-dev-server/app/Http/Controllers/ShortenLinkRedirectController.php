<?php

namespace App\Http\Controllers;

use App\Models\ShortenLink;

class ShortenLinkRedirectController extends Controller
{
    public function shortenLink($slug)
    {
        $findSlug = ShortenLink::where('slug', $slug)->first();
        if($findSlug != null)
            {
                return redirect($findSlug->link);
            }
        else
            {
                return redirect('/')
                ->with(['redirect_error_msg'=>'TinyUrl DOES NOT EXIST']);;
            }
        return redirect('/')
        >with(['error_msg'=>'Something went wrong! Try Again']);;;
    }
}
