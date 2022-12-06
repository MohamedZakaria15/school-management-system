<?php
namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;

use App\Models\Sections;
use App\Models\Student;
use App\Models\Type_Bloods;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Diff\Exception;


    class StudentRepository implements StudentRepositoryInterface{


    public function Create_Students()
    {
        // TODO: Implement Create_Students() method.

        $my_classes = Grade::all();
        $parents=My_Parent::all();
        $Genders=Gender::all();
        $nationals=Nationalitie::all();
        $bloods = Type_Bloods::all();
        return view('pages.Students.add',compact('my_classes','parents','Genders','nationals','bloods'));





    }

    public function Get_classrooms($id)
    {
        // TODO: Implement Get_classrooms() method.
        $list_classes = Classroom::where("Grade_id",$id)->pluck("Name_Class","id");
        return $list_classes;

    }

    public function Get_sections($id)
    {
        $list_sectoins=Sections::where("Class_id",$id)->pluck("Name_Section","id");
        return $list_sectoins;

    }

    public function Store_Students($request)
    {
        // TODO: Implement Store_Students() method.
        try {
            $students= new Student();
            $students->name = ['en'=>$request->name_en, 'ar' =>$request->name_ar];
            $students->email=$request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');

        }
catch (\Exception $exception)
{
    return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);


}
    }

    public function Get_Students()
    {
        // TODO: Implement Get_Students() method.
         $students=Student::all();
         return view('Pages.Students.index',compact('students'));

    }

    public function Edit_Students($id)
    {
        // TODO: Implement Edit_Students() method.
        $data['Grades']=Grade::all();
        $data['parents']=My_Parent::all();
        $data['Gendres']=Gender::all();
        $data['nationals']=Nationalitie::all();
        $data['bloods']= Type_Bloods::all();
        $Students =Student::findOrFail($id);
        return view('Pages.Students.edit',$data,compact('Students'));



    }
    public function Update_Student($request)
    {
        try {
            $students= new Student();
            $students->name = ['en'=>$request->name_en, 'ar' =>$request->name_ar];
            $students->email=$request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.create');

        }
        catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);


        }
    }

        public function Update_Students($request)
        {
            // TODO: Implement Update_Students() method.

            try {
                $Edit_Students = Student::findorfail($request->id);

                $Edit_Students->name = ['en'=>$request->name_en, 'ar' =>$request->name_ar];
                $Edit_Students->email=$request->email;
                $Edit_Students->password = Hash::make($request->password);
                $Edit_Students->gender_id = $request->gender_id;
                $Edit_Students->nationalitie_id = $request->nationalitie_id;
                $Edit_Students->blood_id = $request->blood_id;
                $Edit_Students->Date_Birth = $request->Date_Birth;
                $Edit_Students->Grade_id = $request->Grade_id;
                $Edit_Students->Classroom_id = $request->Classroom_id;
                $Edit_Students->section_id = $request->section_id;
                $Edit_Students->parent_id = $request->parent_id;
                $Edit_Students->academic_year = $request->academic_year;
                $Edit_Students->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Students.create');

            }
            catch (\Exception $exception)
            {
                return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);


            }
        }

        public function Delete_Student($request)
        {
            // TODO: Implement Delete_Student() method.
//            Student::findOrFail($request->id)->delete();
            Student::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Students.index');
        }
    }
