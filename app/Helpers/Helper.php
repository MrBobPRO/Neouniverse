<?php

/**
 * Custom Helper class
 * @author Bobur Nuridinov <bobnuridinov@gmail.com> 
 */

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class Helper {

    /**
     * Return transliterated lowercased string from russian or tajik into latin
     * 
     *
     * @param string $string
     * @return string
     */
    public static function transliterateIntoLatin($string)
    {
        $cyrilic = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я', ' ',
            'ӣ', 'ӯ', 'ҳ', 'қ', 'ҷ', 'ғ', 'Ғ', 'Ӣ', 'Ӯ', 'Ҳ', 'Қ', 'Ҷ',
            '/', '\\', '|', '!', '?', '«', '»', '“', '”'
        ];

        $latin = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya',
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','shb','a','i','y','e','yu','ya', '-',
            'i', 'u', 'h', 'q', 'j', 'g', 'g', 'i', 'u', 'h', 'q', 'j',
            '', '', '', '', '', '', '', '', ''
        ];

        $transilation = str_replace($cyrilic, $latin, $string);

        return strtolower($transilation);
    }


    /**
     * Fill multiple language fileds of item (on create)
     * RU values used as default value for EN/KA values
     *
     * @param \Eloquent\Model $item
     * @param array $fields
     * @param \Http\Request $request
     * @return null
     */
    public static function fillMultiLanguageFields($item, $fields, $request)
    {
         $defaultLanguage = 'ru_';
         $secondaryLanguages = ['en_', 'ka_'];

         foreach($fields as $field) {
             $item[$defaultLanguage . $field] = $request[$defaultLanguage . $field];

             foreach($secondaryLanguages as $secLang) {
                $item[$secLang . $field] = $request[$secLang . $field] ? $request[$secLang . $field] : $request[$defaultLanguage . $field];
             }
         }

         return null;
    }


    /**
     * Store products instruction files
     * RU values used as default value for EN/KA values
     *
     * @param \Eloquent\Model $item
     * @param \Http\Request $request
     * @return null
     */
    public static function storeProductInstructions($product, $request) 
    {
        $defaultLanguage = 'ru_';
        $secondaryLanguages = ['en_', 'ka_'];

        $instructionPath = public_path('instructions/');
        $transliteratedName = Helper::transliterateIntoLatin($request->ru_name);

        // store default instruction
        $instruction = $request->file($defaultLanguage . 'instruction');
        $default_extension = '.' . $instruction->getClientOriginalExtension();
        $instruction->move($instructionPath . str_replace('_', '', $defaultLanguage), $transliteratedName . $default_extension);
        $product[$defaultLanguage . 'instruction'] = $transliteratedName . $default_extension;

        // store seconray instructions
        foreach($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . 'instruction');
            // store instruction if exists
            if($file) {
                $extension = '.' . $file->getClientOriginalExtension();
                $file->move($instructionPath . str_replace('_', '', $secLang), $transliteratedName . $extension);
                $product[$secLang . 'instruction'] = $transliteratedName . $extension;
            // else copy default instruction
            } else {
                $defaultInstructionPath = $instructionPath . str_replace('_', '', $defaultLanguage) . '/' .  $transliteratedName . $default_extension;
                $secondaryInstructionPath = $instructionPath . str_replace('_', '', $secLang) . '/' .  $transliteratedName . $default_extension;
                File::copy($defaultInstructionPath,  $secondaryInstructionPath);
                $product[$secLang . 'instruction'] = $transliteratedName . $default_extension;
            }
        }

        return null;
    }

    public function storeProductImages()
    {
        
    }

}
