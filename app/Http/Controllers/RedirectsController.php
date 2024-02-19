<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Redirect;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RedirectsController extends Controller
{

    private function gethttpstatuscode($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
        curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }

    public function index()
    {
        $hashids = new Hashids('', 10);

        $redirects = Redirect::all();

        $isApi =  request()->wantsJson() || str_starts_with(request()->path(), 'api');

        $encodedRedirects = array();


        foreach ($redirects as $key => $value) {
            $encodedRedirects[$key] = [
                "id" => (string) $hashids->encode($value->id),
                "status" => (string) $value->status ? 'true' : 'false',
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
        $isApi =  request()->wantsJson() || str_starts_with(request()->path(), 'api');
        $destination = $request->destination;
        $httpStatusCode = $this->gethttpstatuscode($destination);
        $siteRoot = url('/');
        $status = $request->status;

        $validator = Validator::make($request->all(), [
            'destination' => 'required|url:https',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $validated = $validator->validated();

        $redirect = new Redirect([
            'destination' => $validated['destination'],
            'status' => $isApi ? 1 : $status
        ]);

        if ($destination != $siteRoot) {
            if ($httpStatusCode == 200) {
                $redirect->save();
            } else {
                return response()->json("Http status code is not 200", Response::HTTP_EXPECTATION_FAILED);
            }
        } else {
            return response()->json("It will not be possible to save the root address", Response::HTTP_EXPECTATION_FAILED);
        }

        if ($isApi) {
            return response()->json($redirect, Response::HTTP_CREATED); // Return the new post as JSON
        } else {
            return redirect()->route('redirects-index');
        }
    }

    public function edit($id)
    {

        $hashids = new Hashids('', 10);

        $decodedId = $hashids->decode($id);
        $redirect = Redirect::where('id', $decodedId)->first();

        if (!empty($redirect)) {
            return view('redirects.edit', ['redirect' => $redirect]);
        } else {
            return redirect()->route('redirects-index');
        }
    }
    public function update(Request $request, $id)
    {

        $isApi =  request()->wantsJson() || str_starts_with(request()->path(), 'api');
        $destination = $request->destination;
        $httpStatusCode = $this->gethttpstatuscode($destination);
        $siteRoot = url('/');
        $status = $request->status;

        $validator = Validator::make($request->all(), [
            'destination' => 'required|url:https',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $validated = $validator->validated();

        $updatedRedirect = new Redirect([
            'destination' => $validated['destination'],
            'status' => $isApi ? 1 : $status
        ]);

        $data = [
            'status' => $updatedRedirect->status,
            'destination' => $updatedRedirect->destination,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($destination != $siteRoot) {
            if ($httpStatusCode == 200) {
                $updatedRedirect->where('id', $id)->update($data);
            } else {
                return response()->json("Http status code is not 200", Response::HTTP_EXPECTATION_FAILED);
            }
        } else {
            return response()->json("It will not be possible to save the root address", Response::HTTP_EXPECTATION_FAILED);
        }

        if ($isApi) {
            return response()->json($updatedRedirect, Response::HTTP_OK);
        } else {
            return redirect()->route('redirects-index');
        }
    }

    public function destroy($id)
    {

        $isApi =  request()->wantsJson() || str_starts_with(request()->path(), 'api');

        $hashids = new Hashids('', 10);

        $decodedId = $hashids->decode($id);

        Redirect::where('id', $decodedId)->delete();

        if ($isApi) {
            return response()->json('Successfully deleted', Response::HTTP_OK);
        } else {
            return redirect()->route('redirects-index');
        }
    }
    public function redirect($destination)
    {


        $data = [
            'request_ip' => $_SERVER['REMOTE_ADDR'],
            'user_agente' => $_SERVER['HTTP_USER_AGENT'],
            'header_referer' => $_SERVER['HTTP_REFERER'],
            'query_params' => $_SERVER['QUERY_STRING'],
        ];


        return response()->json($_SERVER['REMOTE_ADDR'], Response::HTTP_OK);
    }
}
