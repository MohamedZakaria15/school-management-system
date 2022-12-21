<?php

namespace App\Repository;

use App\Http\Requests\StoreFeesRequest;
use App\Models\Fee_invoice;
use App\Models\Fees;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Diff\Exception;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{


    public function index()
    {
        $Fee_invoices=Fee_invoice::all();
        $Grades=Grade::all();
        return view('pages.Fees_Invoices.index',compact('Fee_invoices','Grades'));


    }

    public function show($id)
    {
        $Student = Student::findOrfail($id);
        $fees=Fees::where('Classroom_id',$Student->Classroom_id)->get();
        return view('pages.Fees_Invoices.add',compact('Student','fees'));

    }

    public function create()
    {

    }

    public function edit($id)
    {
        $fees_invoices= Fee_invoice::findorfail($id);
        $fees = Fees::where('Classroom_id',$fees_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit',compact('fees_invoices','fees'));

    }

    public function store( $request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fee_invoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->Grade_id = $request->Grade_id;
                $StudentAccount->Classroom_id = $request->Classroom_id;
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        }

    public function update($request)
    {

        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = Fee_invoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}
