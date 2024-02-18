<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;

class RedirectsController extends Controller
{
    public function index()
    {
        $redirects = Redirect::all();


        // foreach ($redirects as $redi) {
        //     // $arr[3] will be updated with each value from $arr...
        //     print_r(Hashids::encode($redi->id));
        // }
        // dd($redirects);

        return view('redirects.index', ['redirects' => $redirects]);
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
