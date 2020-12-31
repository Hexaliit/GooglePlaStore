<?php

namespace App\Http\Controllers;

use App\Imports\AppsImport;
use App\Imports\CommentsImport;
use App\Models\App;
use App\Models\Comment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AppController extends Controller
{
    public function importApps()
    {
        set_time_limit(0);
        Excel::import(new AppsImport, 'googleplaystore.csv');
        return redirect('/')->with('success', 'All good!');
    }

    public function importComments()
    {
        set_time_limit(0);
        Excel::import(new CommentsImport, 'googleplaystore_user_reviews.csv');
        return redirect('/')->with('success', 'All good!');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->search;
        $apps = App::whereRaw('match(name) against (? in Boolean mode)', $searchTerm)->get();
        return response()->json($apps, 200);
    }

    public function index()
    {
        $apps = App::paginate(20);
        return response()->json($apps, 200);
    }

    public function show($id)
    {
        $app = App::find($id);
        $comments = Comment::where('app', $app->name)->paginate(20);
        return ['app' => $app, 'comments' => $comments];
    }

    public function showCategories()
    {
        $apps = App::select('category')->groupBy('category')->get();
        $apps = $this->toArr($apps,'category');
        $apps = array_unique($apps);
        return response()->json($apps, 200);
    }

    public function showGenres()
    {
        $apps = App::select('genres')->groupBy('genres')->get();
        $apps = $this->toArr($apps,'genres');
        $apps = array_unique($apps);
        return response()->json($apps, 200);
    }

    private function toArr($object,$ref)
    {
        $arr = [];
        foreach ($object as $obj) {
            if (str_contains($obj[$ref], ';')) {
                $arr[] = explode(';', $obj[$ref])[1];
            } else {
                $arr[] = $obj[$ref];
            }
        }
        return $arr;
    }

    public function showByCategory($category)
    {
        $apps = App::where('category', $category)->paginate(20);
        return response()->json($apps, 200);
    }
    public function showByGenre($genre)
    {
        $apps = App::where('genres', $genre)->paginate(20);
        return response()->json($apps, 200);
    }
    public function comments($id)
    {
        $app = App::find($id);
        $appName = $app->name;
        $comments = Comment::where('app', $appName)->paginate(20);
        return response()->json($comments, 200);
    }

    public function showByRating(Request $request)
    {
        if ($request->from < 0 && $request->to > 5) {
            return response()->json(null, 404);
        }
        $apps = App::where('rating', '>', $request->from)->where('rating', '<', $request->to)->paginate(20);
        return response()->json($apps, 200);
    }

    public function showFree()
    {
        $apps = App::where('type', 'Free')->paginate(20);
        return response()->json($apps, 200);
    }

    public function showPaid()
    {
        $apps = App::where('type', 'Paid')->orderBy('price', 'asc')->paginate(20);
        return response()->json($apps, 200);
    }
}
