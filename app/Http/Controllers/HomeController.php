<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Session;
use App\Models\Data;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Imports\DataImport;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function tempData()
    {
        return view('temp-data');
    }

    public function permanentData()
    {
        $data = Data::all();
        return view('permanent-data', compact('data'));
    }

    public function submitForm(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'email' => 'required|email',
            'image' => 'required|image',
            'mobile' => 'required|numeric',
            'date' => 'required|date',
            'role' => 'required',
        ]);

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        } else {
            $imagePath = null;
        }

        $data = $req->except('_token', 'image');
        $data['image'] = $imagePath;
        $data['id'] = uniqid();

        $sessionData = Session::get('formData', []);
        $sessionData[] = $data;
        Session::put('formData', $sessionData);

        session()->flash('success', 'Data submitted successfully');
        return redirect()->back();
    }

    public function deleteData($id)
    {
        $sessionData = Session::get('formData', []);
        foreach ($sessionData as $index => $data) {
            if ($data['id'] == $id) {
                if (isset($data['image']) && File::exists(public_path($data['image']))) {
                    File::delete(public_path($data['image']));
                }
                unset($sessionData[$index]);
                break;
            }
        }
        Session::put('formData', array_values($sessionData));
        session()->flash('success', 'Entry deleted successfully');
        return redirect('/temp-data');
    }
    public function editData($id)
    {
        $sessionData = Session::get('formData', []);
        $editData = null;
        foreach ($sessionData as $data) {
            if ($data['id'] == $id) {
                $editData = $data;
                break;
            }
        }
        return view('edit-data', compact('editData'));
    }

    public function updateData(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'email' => 'required|email',
            'image' => 'image', // Make image optional
            'mobile' => 'required|numeric',
            'date' => 'required|date',
            'role' => 'required',
        ]);

        $sessionData = Session::get('formData', []);
        foreach ($sessionData as &$data) {
            if ($data['id'] == $req->input('id')) {
                $data['name'] = $req->input('name');
                $data['password'] = $req->input('password');
                $data['email'] = $req->input('email');
                $data['mobile'] = $req->input('mobile');
                $data['date'] = $req->input('date');
                $data['role'] = $req->input('role');

                if ($req->hasFile('image')) {
                    if (isset($data['image']) && File::exists(public_path($data['image']))) {
                        File::delete(public_path($data['image']));
                    }
                    $image = $req->file('image');
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $data['image'] = 'images/' . $imageName;
                }
                break;
            }
        }
        Session::put('formData', $sessionData);
        session()->flash('success', 'Data updated successfully');
        return redirect('temp-data');
    }

    public function finalSubmit()
    {
        $data = Session::get('formData', []);
        foreach ($data as $item) {
            Data::create($item);
        }

        Session::forget('formData');

        session()->flash('success', 'All data has been submitted successfully to the database.');
        return redirect('temp-data');
    }

    public function downloadExcel()
    {
        return Excel::download(new DataExport(), 'data.xlsx');
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new DataImport(), $request->file('file')->store('temp'));

        session()->flash('success', 'Data imported successfully.');
        return redirect()->back();
    }
}
