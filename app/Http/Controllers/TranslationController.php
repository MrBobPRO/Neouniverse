<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class TranslationController extends Controller
{
    public function dashboardIndex(Request $request)
    {
        $languages = collect([
            ['name' => 'Английский', 'tag' => 'en'],
            ['name' => 'Грузинский', 'tag' => 'ka']
        ]);

        return view('dashboard.translations.index', compact('languages'));
    }

    public function dashboardSingle($tag)
    {
        $file = file_get_contents(base_path('resources/lang/' . $tag . '.json'));

        return view('dashboard.translations.single', compact('file', 'tag'));
    }

    public function update(Request $request)
    {
        dd($request->dada);
        $option = Option::find($request->id);

        $multiLanguageFields = ['value'];
        Helper::fillMultiLanguageFields($request, $option, $multiLanguageFields);

        $option->save();

        return redirect()->back();
    }
}
