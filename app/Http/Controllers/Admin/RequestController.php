<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Request as RequestModel;
use App\User;
use Auth;
use Carbon\Carbon;
use Storage;

class RequestController extends Controller
{
    // .で区切る
    private $genres = [];
    
    public function __construct()
    {
        $this->genres = config('app.genres');
        $this->prefectures = $this->getPrefectures();
    }
    
    public function add() {
        $prefectures = $this->prefectures;
        $genres = $this->genres;
        
        return view('admin.request.create', [
            'genres' => $genres,
            'prefectures' => $prefectures,
            ]);
    }
    
    public function create(Request $request) {
        // Repuestファザード？
        $this->validate($request, RequestModel::$rules);
        $request_model = new RequestModel;
        $request_model->user_id = $request->user()->id;
        $form = $request->all();
        
        // for ($i = 0; $i < 5; $i++) {
        //     if (isset($form['image'])) {
        //         $path = Storage::disk('s3')->putFile('/',$form['image'], 'public');
        //         $request->image_path = Storage::disk('s3')->url($path);
        //     } else {
        //         $request->image_path = null;
        //     }
        // }
        for ($i = 0; $i < 5; $i++) {
            if (isset($form['image'][$i])) {
                $path = $request->file('image')[$i]->store('public/image');
                $request_model->{'image_path_'.($i + 1)} = basename($path);
              } else {
                  $request_model->{'image_path_'.($i + 1)} = null;
              }
        }
        
        unset($form['_token']);
        unset($form['image']);
        $request_model->fill($form);
        // dd($request_model);
        $request_model->fill($form)->save();
        
        return redirect('/');
    }
    
    public function edit(Request $request) {
        // $genresList = [
        //     'genres' => $this->genres,
        //     ];

        $genres = $this->genres;
        $prefectures = $this->prefectures;
        
        $request_model = RequestModel::find($request->id);
        if (empty($request_model)) {
            abort(404);
        }
        
        return view('admin.request.edit', [
            'request_form' => $request_model,
            'genres' => $genres,
            'prefectures' => $prefectures,
            ]);
    }
    
    public function update(Request $request) {
        $this->validate($request, RequestModel::$rules);
        $request_model = RequestModel::find($request->id);
        $request_form = $request->all();
        // $request_formと$request_modelについて
        
        for ($i = 0; $i < 5; $i++) {
            $j += 1;
            if ($request->remove) {
                $request_form->{'image_path_'.$j} = null;
            } elseif (isset($request_form['image'][$i])) {
                $path = $request->file('image')[$i]->store('public/image');
                $request_form['image_path_'.$j] = basename($path);
            } else {
                $request_form['image_path_'.$j] = $request_model->{'image_path_'.$j};
            }
        }
        
        unset($request_form['image']);
        unset($request_form['remove']);
        unset($request_form['_token']);
        $request_model->fill($request_form)->save();
        
        return redirect('/');
    }
    
    public function delete(Request $request) {
        $request_model = RequestModel::find($request_model->id);
        $request_model->delete();
        return redirect('/');
    }
    
    private function getPrefectures()
    {
        $result = \DB::table('prefectures')->get()->pluck("name");
        return $result;
    }
}
