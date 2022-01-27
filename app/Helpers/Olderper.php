<?php

/**
 * Custom Helper class
 * @author Bobur Nuridinov <bobnuridinov@gmail.com> 
 */

namespace App\Olderper;

use Illuminate\Support\Facades\File;
use Image;

class Olderper {

    const DEFAULT_LANGUAGE = 'ru_';
    const SECONDARY_LANGUAGES = ['en_', 'ka_'];

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
     * Copy default languages values for the requests secondary language filends that are not filled 
     *
     * @param \Eloquent\Model $item
     * @param array $fields
     * @param \Http\Request $request
     * @return null
     */
    public static function copyFromDefaultFields($request, $item, $fields)
    {
         $defaultLanguage = Helper::DEFAULT_LANGUAGE;
         $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

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
     * @param \Http\Request $request
     * @param \Eloquent\Model $item
     * @return null
     */
    public static function storeProductInstructions($request, $product) 
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $instructionPath = public_path('instructions/');
        $transliteratedName = Helper::transliterateIntoLatin($request->ru_name);

        // store default instruction
        $instruction = $request->file($defaultLanguage . 'instruction');
        $defaultExtension = '.' . $instruction->getClientOriginalExtension();
        $instruction->move($instructionPath . str_replace('_', '', $defaultLanguage), $transliteratedName . $defaultExtension);
        $product[$defaultLanguage . 'instruction'] = $transliteratedName . $defaultExtension;

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
                $defaultInstructionPath = $instructionPath . str_replace('_', '', $defaultLanguage) . '/' .  $transliteratedName . $defaultExtension;
                $secondaryInstructionPath = $instructionPath . str_replace('_', '', $secLang) . '/' .  $transliteratedName . $defaultExtension;
                File::copy($defaultInstructionPath,  $secondaryInstructionPath);
                $product[$secLang . 'instruction'] = $transliteratedName . $defaultExtension;
            }
        }

        return null;
    }

    public function storeProductImages($request, $product)
    {
        // Upload products default image
        static::uploadProductsDefaultImage($request, $product);
        // Copy products default language image & thumb for all secondary languages
        static::copyProductsDefaultImage($request, $product);
        // Replace products secondary language images with default language image
        static::uploadProductsSecondaryImages($request, $product);

        return null;
    }

    private static function uploadProductsDefaultImage($request, $product)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;

        $imagePath = public_path('img/products/');
        $transliteratedName = Helper::transliterateIntoLatin($request->ru_name);
        
        // store default image
        $image = $request->file($defaultLanguage . 'image');
        $fullName = $transliteratedName . '.' . $image->getClientOriginalExtension();
        $image->move($imagePath . str_replace('_', '', $defaultLanguage), $fullName);
        $product[$defaultLanguage . 'image'] = $fullName;

        // make thumb from original and store it
        $original = Image::make($imagePath . str_replace('_', '', $defaultLanguage) . '/' . $fullName);
        $original->resize(400, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $original->save($imagePath . str_replace('_', '', $defaultLanguage) . '/thumbs//' . $fullName);
    }


    /**
     * copy default image & thumb for all secondary languages
     *
     * @param string $fullName
     * @return void
     */
    private static function copyProductsDefaultImage($product)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $fullName = $product[$defaultLanguage . 'image'];

        $imagePath = public_path('img/products/');
        $defaultImagePath = $imagePath . str_replace('_', '', $defaultLanguage) . '/' .  $fullName;
        $defaultThumbPath = $imagePath . str_replace('_', '', $defaultLanguage) . '/thumbs//' .  $fullName;

        foreach($secondaryLanguages as $secLang) {
            // copy image from original
            $secondaryImagePath = $imagePath . str_replace('_', '', $secLang) . '/' .  $fullName;
            File::copy($defaultImagePath,  $secondaryImagePath);
            $product[$secLang . 'image'] = $fullName;

            // copy thumb from original
            $secondaryThumbPath = $imagePath . str_replace('_', '', $secLang) . '/thumbs//' .  $fullName;
            File::copy($defaultThumbPath,  $secondaryThumbPath);
        }
    }

    private static function uploadProductsSecondaryImages($transliteratedName, $request)
    {
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;
        $imagePath = public_path('img/products/');

        foreach($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . 'image');
            if($file) {
                $fullName = $transliteratedName . '.' . $file->getClientOriginalExtension();

                $file->move($imagePath . str_replace('_', '', $secLang), $fullName);
                $product[$secLang . 'image'] = $fullName;

                // create thumb
                $thumb = Image::make($imagePath . str_replace('_', '', $secLang) . '/' . $fullName);
                $thumb->resize(400, null, function($constraint) {
                    $constraint->aspectRatio();
                });
                $thumb->save($imagePath . str_replace('_', '', $secLang) . '/thumbs//' . $fullName);
            } 
        }
    }
    

}
