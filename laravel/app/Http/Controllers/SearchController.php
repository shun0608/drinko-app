<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Search for drinks based on the keyword.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        $query = DB::table('drinks');

        $query->select('id', 'name_en', 'name_ja', 'image_url');

        if ($keyword !== null) {
            $search_split = mb_convert_kana($keyword, 's');
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($search_split2 as $value) {
                $query->orWhere('name_en', 'LIKE', '%'.$value.'%')->orWhere('name_ja', 'LIKE', '%'.$value.'%');
            }
        }
        $drinks = $query->paginate(12)->withPath('/search')->appends(['keyword' => $keyword]);

        return response()->json($drinks);
    }
}
