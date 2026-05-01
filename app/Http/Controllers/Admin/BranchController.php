<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BranchController extends Controller
{
    //
    public function index(){
       
    //     if (request()->ajax()) {
    //         $branches = Branch::all();
    //         return response()->json($branches);
    //     }
    //     //Not yet Deployed
    //    return view('admin.dashboard', compact('branches'));
        $menuItems=[];
        return view('branch.branch-dashboard', compact('menuItems'));
        //return view('branch.dashboard', compact('menuItems'));
    }


    public function show($id){
        $branch = Branch::findOrFail($id);
        return view('branch.branch-dashboard', compact('branch'));
    }
   
    
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'capacity' => 'required|integer',
            'is_active' => 'required|boolean'->default(true),
        ]);
        Branch::create($validated);
        return redirect()->route('branches.index')->with('success', 'تم إضافة الفرع بنجاح');
    }


    public function update(Request $request, $id){
        $branch = Branch::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'capacity' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);
        $branch->update($validated);
        return redirect()->route('branch.dashboard', $branch)->with('success', 'تم تحديث بيانات الفرع بنجاح');
    }
    
    public function destroy($id){
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return redirect()->route('admin.dashboard')->with('success', 'تم حذف الفرع بنجاح');
    }
    
}
