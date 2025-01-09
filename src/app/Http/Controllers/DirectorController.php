<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function create() {
        return view('directors.create');
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'born_year' => 'required',
            'about' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3096',
        ], [
            'first_name.required' => 'Моля, въведете име на режисьора.',
            'last_name.required' => 'Моля, въведете фамилия на режисьора.',
            'born_year.required' => 'Моля, въведете година на раждане на режисьора.',
            'about.required' => 'Моля, въведете информация за режисьора.',
            'about.max' => 'Информацията не може да съдържа повече от 255 символа.',
            "image.required" => "Моля, прикачете снимка на режисьора.",
            "image.image" => "Невалиден файлов формат. Валидни файлови формати: jpeg,png,jpg,gif",
            "image.max" => "Файлът не трябва да надвишава 3 MB."
        ]);

        $filePath = $request->file('image')->store('images', 'public');

        Director::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'born_year' => $request->born_year,
            'about' => $request->about,
            'image_path' => $filePath
        ]);

        return redirect()->route('movies.index')->with('success', 'Режисьорът беше създаден успешно!');
    }
}
