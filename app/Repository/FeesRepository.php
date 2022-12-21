<?php

namespace App\Repository;

use App\Models\Fees;
use App\Models\Grade;
use App\Models\Student;
use http\Env\Request;
use SebastianBergmann\Diff\Exception;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {

        $students =Student::all();
        $Fees=Fees::all();
        $Grades=Grade::all();
        return view('pages.Fees.index',compact('students','Grades','Fees'));

    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.Fees.add',compact('Grades'));

    }

    public function edit($id)
    {
        $fee =Fees::findOrfail($id);
        $Grades=Grade::all();
        return view('pages.Fees.edit',compact('fee','Grades'));
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store($request)
    {
        try {

            $fees = new Fees();
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->description = $request->description;
            $fees->year = $request->year;
            $fees->Fee_type = $request->Fee_type;
            $fees->save();
            toastr()->success('messages.success');

            return redirect()->route('Fees.create');

    }
    catch (\Exception $exception)
    {
        return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);

        }
    }


    public function update($request)
    {
        $fees = Fees::findorfail($request->id);
        $fees->title =['en' => $request->title_en,'ar'=> $request->title_ar];
        $fees->amount =$request->amount;
        $fees->Grade_id =$request->Grade_id;
        $fees->Classroom_id = $request->Classroom_id;
        $fees->description= $request->description;
        $fees->year =$request->year;
        $fees->Fee_type= $request->Fee_type;
        $fees->save();
        toastr()->success(trans('messages.Update'));
        return redirect()->route('Fees.index');
    }

    public function destroy($request)
    {
        try{
            Fees::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }
        catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);
        }
    }
}
