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
        Excel::import(new AppsImport, 'googleplaystore.csv');
        return redirect('/')->with('success', 'All good!');
    }
    public function importComments()
    {
        set_time_limit(0);
        Excel::import(new CommentsImport,'googleplaystore_user_reviews.csv');
        return redirect('/')->with('success', 'All good!');
    }
    public function search(Request $request)
    {
        $searchTerm = $request->search;
        $apps = App::whereRaw('match(name) against (? in Boolean mode)',$searchTerm)->get();
        return response()->json($apps,200);
    }
    public function index()
    {
        $apps = App::paginate(20);
        return response()->json($apps, 200);
    }

    public function show($id)
    {
        $app = App::find($id);
        $comments = Comment::where('app',$app->name)->paginate(20);
        return response()->json(['app'=>$app,'comments'=>$comments], 200);
    }

    public function showCategories()
    {
        $apps = App::select('category')->groupBy('category')->get();
        return response()->json($apps, 200);
    }

    public function showByCategory($category)
    {
        $apps = App::where('category', $category)->get();
        return response()->json($apps, 200);
    }

    public function showByRating(Request $request)
    {
        if ($request->from < 0 && $request->to > 5)
        {
            return response()->json(null, 404);
        }
        $apps = App::where('rating', '>', $request->from)->where('rating', '<', $request->to)->get();
        return response()->json($apps, 200);
    }
    public function showFree()
    {
        $apps = App::where('type','Free')->paginate(20);
        return response()->json($apps,200);
    }
    public function showPaid()
    {
        $apps = App::where('type','Paid')->orderBy('price','asc')->paginate(20);
        return response()->json($apps,200);
    }
}
