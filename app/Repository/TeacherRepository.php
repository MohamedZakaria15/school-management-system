<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\Specializations;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function GetSpecialization()
    {
        // TODO: Implement GetSpecialization() method.
        return Specializations::all();

    }
    public function GetGender()
    {
        // TODO: Implement GetGender() method.
        return Gender::all();
    }
    public function StoreTeachers($request)
    {
        try {
            $Teachers = new Teacher();
            $Teachers->Email = $request->Email;
            $Teachers->Password = Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.create');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

        public function UpdateTeachers($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.index');
        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }


    }

    public function editTeachers($id)
    {
        $Teachers=Teacher::findOrFail($id);
        return $Teachers;
    }

     public function DeleteTeachers($request)
     {
         Teacher::findOrFail($request->id)->delete();
         toastr()->error(trans('messages.Delete'));
         return redirect()->route('Teachers.index');

     }

}
