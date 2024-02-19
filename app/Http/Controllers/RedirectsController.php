<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RedirectsController extends Controller
{
    public function index()
    {
        $hashids = new Hashids('', 10); // pad to length 10

        $redirects = Redirect::all();

        $isApi =  request()->wantsJson() || str_starts_with(request()->path(), 'api');

        $encodedRedirects = array();


        foreach ($redirects as $key => $value) {
            $encodedRedirects[$key] = [
                "id" => (string) $hashids->encode($value->id),
                "status" => $value->status,
                "destination" => $value->destination,
                "last_access" => $value->last_access,
                "created_at" => $value->created_at,
                "updated_at" => $value->updated_at
            ];
        };


        if ($isApi && !!$encodedRedirects) {
            return response()->json($encodedRedirects, Response::HTTP_OK);
        } else {
            return view('redirects.index', ['redirects' => $encodedRedirects]);
        };
    }

    public function create()
    {
        return view('redirects.create');
    }

    public function store(Request $request)
    {
        Redirect::create($request->all());
        return redirect()->route('redirects-index');
    }
}
