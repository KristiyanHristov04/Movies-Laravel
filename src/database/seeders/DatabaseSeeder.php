<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $languages = [
            'Afrikaans',
            'Albanian',
            'Amharic',
            'Arabic',
            'Armenian',
            'Azerbaijani',
            'Basque',
            'Belarusian',
            'Bengali',
            'Bosnian',
            'Bulgarian',
            'Burmese',
            'Catalan',
            'Cebuano',
            'Chinese',
            'Corsican',
            'Croatian',
            'Czech',
            'Danish',
            'Dutch',
            'English',
            'Esperanto',
            'Estonian',
            'Finnish',
            'French',
            'Galician',
            'Georgian',
            'German',
            'Greek',
            'Gujarati',
            'Haitian Creole',
            'Hausa',
            'Hebrew',
            'Hindi',
            'Hungarian',
            'Icelandic',
            'Igbo',
            'Indonesian',
            'Irish',
            'Italian',
            'Japanese',
            'Javanese',
            'Kannada',
            'Kazakh',
            'Khmer',
            'Korean',
            'Kurdish',
            'Kyrgyz',
            'Lao',
            'Latin',
            'Latvian',
            'Lithuanian',
            'Luxembourgish',
            'Macedonian',
            'Malagasy',
            'Malay',
            'Malayalam',
            'Maltese',
            'Maori',
            'Marathi',
            'Mongolian',
            'Nepali',
            'Norwegian',
            'Odia',
            'Pashto',
            'Persian',
            'Polish',
            'Portuguese',
            'Punjabi',
            'Quechua',
            'Romanian',
            'Russian',
            'Samoan',
            'Scots Gaelic',
            'Serbian',
            'Shona',
            'Sindhi',
            'Sinhala',
            'Slovak',
            'Slovenian',
            'Somali',
            'Spanish',
            'Sundanese',
            'Swahili',
            'Swedish',
            'Tagalog',
            'Tajik',
            'Tamil',
            'Tatar',
            'Telugu',
            'Thai',
            'Tigrinya',
            'Turkish',
            'Turkmen',
            'Ukrainian',
            'Urdu',
            'Uyghur',
            'Uzbek',
            'Vietnamese',
            'Welsh',
            'Xhosa',
            'Yiddish',
            'Yoruba',
            'Zulu'
        ];

        foreach ($languages as $language) {
            Language::firstOrCreate(['language_name' => $language]);
        }
        
    }
}
