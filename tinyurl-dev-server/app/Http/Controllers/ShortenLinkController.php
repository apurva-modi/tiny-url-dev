<?php

namespace App\Http\Controllers;

use App\Models\ShortenLink;
use Illuminate\Http\Request;


class ShortenLinkController extends Controller
{

    public function index()
    {
        $ShortenLinks = ShortenLink::latest()->get();
        return view('shortenLink', compact('ShortenLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);

        $FindLink =  ShortenLink::whereLink($request->link)->first();

        if($FindLink == null)
            {

                $slugCheck = $this->generateSlug();
                $input['link'] = $request->link;
                $input['slug'] = $slugCheck;

                ShortenLink::create($input);

                $FindLink =  ShortenLink::whereLink($request->link)->first();

                return back()
                    ->with([
                        'success_msg'=>'TinyURL Generated Successfully!',
                        "originalUrl" => $FindLink->link,
                        "shortenedUrl" => env("APP_URL") . "/" . $FindLink->slug
                        ]);
                }
            else
                {
                    return back()
                    ->with([
                        'error_msg'=>'TinyURL already generated!',
                        "originalUrl" => $FindLink->link,
                        "shortenedUrl" => env("APP_URL") . "/" . $FindLink->slug

                        ]);

                }
            return redirect('/')
                    ->with([
                        'error_msg'=>'Something went wrong! Try Again',
                    ]);;;
    }

    public function apiStore(Request $request){
        $request->validate([
           'link' => 'required|url'
        ]);

        $link =  ShortenLink::whereLink($request->link)->first();

        if($link == null)
            {

                $slugCheck = $this->generateSlug();
                $input['link'] = $request->link;
                $input['slug'] = $slugCheck;

                ShortenLink::create($input);
                $link = ShortenLink::whereLink($request->link)->first();
                return response()->json([
                    "msg" => "TinyURL Generated Successfully!",
                    "originalUrl" => $link->link,
                    "shortenedUrl" => env("APP_URL") . "/" . $link->slug
                    ]);

            }
        else
            {
                return response()->json([
                    "msg" => "TinyURL already generated!",
                    "originalUrl" => $link->link,
                    "shortenedUrl" => env("APP_URL") . "/" . $link->slug
                    ]);
            }
    }

    public function generateSlug()
    {
        $result =  base_convert(rand(1,9999),8, 10);
        $findSlug = ShortenLink::whereSlug($result)->first();

        if($findSlug != null)
            {
                return redirect('/')
                    ->with(['error_msg'=>'Slug for the TinyUrl already generated!']);
            }
        else
            {
                return $result;
            }

            return redirect('/')
                ->with(['error_msg'=>'Something went wrong! Try Again']);;;

    }
}
