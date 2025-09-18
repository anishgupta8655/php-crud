<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class Hero_Controller extends Controller
{
    public function heroSaved()


    {
        // Fetch all heroes (latest first)
        $heroes = Hero::latest()->get();

        // Pass to blade
        return view('herosection.heroSaved', compact('heroes'));
    }

    public function heroSend(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save the image
        if ($request->hasFile('background_image')) {
            $imageName = time() . '.' . $request->background_image->extension();
            $request->background_image->move(public_path('uploads/heroes'), $imageName);
            $validatedData['background_image'] = $imageName;
        }

        // Later: Save $validatedData into DB if needed

        Hero::create($validatedData);

        return redirect() ->route('heroSaved')->with('success to hero Section data in db', 'Hero section saved successfully!');
    }
}
