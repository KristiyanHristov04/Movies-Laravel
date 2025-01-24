<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class AdminDirectorController extends Controller
{
    public function index()
    {
        $directorsPerPage = 5;
        $directors = Director::orderby('id', 'desc')->paginate($directorsPerPage);

        return view('admin.directors', [
            'directors' => $directors,
            'counter' => 0
        ]);
    }

    public function edit($id)
    {
        $director = Director::find($id);
        if (!$director) {
            return redirect()->route('admin.directors.index')->with('error', 'Не съществува такъв ресурс!');
        }

        return view('admin.director-edit', [
            'director' => $director,
        ]);
    }

    public function update($id, Request $request)
    {
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
        $director = Director::find($id);

        $director->first_name = $request->first_name;
        $director->last_name = $request->last_name;
        $director->born_year = $request->born_year;
        $director->about = $request->about;
        $director->image_path = $filePath;
        $director->save();

        return redirect()->route('admin.directors.index')->with('success', 'Режисьорът беше редактиран успешно!');
    }

    public function destroy($id)
    {
        $director = Director::find($id);
        if (!$director) {
            return redirect()->route('admin.directors.index')->with('error', 'Не съществува такъв ресурс!');
        }

        $director->delete();

        return redirect()->route('admin.directors.index')->with('success', 'Режисьорът беше изтрит успешно!');
    }
}
