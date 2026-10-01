<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplianceController extends Controller
{
    public function document(string $filename)
    {
        $filePath = public_path('uploads/compliance/' . basename($filename));

        abort_unless(is_file($filePath), 404);

        return response()->file($filePath);
    }

    public function index(Request $request){
        $compliance = \App\Models\ComplianceViolation::orderBy('created_at', 'desc')->paginate(10);

        return view('sailor.compliance.index', compact('compliance'));
    }

public function homeIndex(Request $request)
{
    $perPage = in_array((int) $request->get('per_page', 10), [10, 20, 50], true)
        ? (int) $request->get('per_page', 10)
        : 10;

    $query = \App\Models\ComplianceViolation::orderBy('created_at', 'desc');

    if ($request->has('ship_name') && $request->ship_name != '') {
        $query = $query->where('ship_name', 'like', '%' . $request->ship_name . '%');
    }

    if ($request->has('owner_name') && $request->owner_name != '') {
        $query = $query->where('owner_name', 'like', '%' . $request->owner_name . '%');
    }

    if ($request->filled('fishing_gear_type')) {
        $query->where('fishing_gear_type', $request->fishing_gear_type);
    }

    if ($request->filled('date_from')) {
        $date_from = \Carbon\Carbon::parse($request->date_from)->startOfDay();
        $query->whereDate('date', '>=', $date_from);
    }

    if ($request->filled('date_to')) {
        $date_to = \Carbon\Carbon::parse($request->date_to)->endOfDay();
        $query->whereDate('date', '<=', $date_to);
    }

    $compliance = $query->paginate($perPage)->appends($request->query());
    $fishingGearTypes = \App\Models\ComplianceViolation::query()
        ->whereNotNull('fishing_gear_type')
        ->where('fishing_gear_type', '!=', '')
        ->distinct()
        ->orderBy('fishing_gear_type')
        ->pluck('fishing_gear_type');

    return view('sailor.home.compliance', compact('compliance', 'fishingGearTypes', 'request'));
}


    public function create(){
        return view('sailor.compliance.add');
    }

    public function store(Request $request){
		$document_name = '';
		
		if($request->hasFile('document')){
			$document = $request->file('document');
			$document_name = time() . '_' . $document->getClientOriginalName();
			$document->move('uploads/compliance/', $document_name);
		}

		$compliance = new \App\Models\ComplianceViolation;
			
		$compliance->ship_name = $request->ship_name;
		$compliance->owner_name = $request->owner_name;
		$compliance->captain_name = $request->captain_name;
		$compliance->address = $request->address;
		$compliance->gt = $request->gt;
		$compliance->fishing_gear_type = $request->fishing_gear_type;
		$compliance->coordinates = $request->coordinates;
		$compliance->catch_type = $request->catch_type;
		$compliance->date = $request->date;
		$compliance->document_path = $document_name;
		$compliance->compliance = $request->compliance;
		
		$compliance->save();


        return response()->json([
            'status' => 'success',
            'message' => 'Kepatuhan & Pelanggaran  berhasil disimpan',
        ]);
    }

    public function edit(\App\Models\ComplianceViolation $compliance){
        return view('sailor.compliance.edit', compact('compliance'));
    }

    public function update(Request $request, \App\Models\ComplianceViolation $compliance){
        $document_name = '';
		
		if($request->hasFile('document')){
			if($compliance->document_path!='')
				unlink('uploads/compliance/' . $compliance->document_path);
			
			$document = $request->file('document');
			$document_name = time() . '_' . $document->getClientOriginalName();
			$document->move('uploads/compliance/', $document_name);

			$compliance->document_path = $document_name;
		}

		$compliance->ship_name = $request->ship_name;
		$compliance->owner_name = $request->owner_name;
		$compliance->captain_name = $request->captain_name;
		$compliance->address = $request->address;
		$compliance->gt = $request->gt;
		$compliance->fishing_gear_type = $request->fishing_gear_type;
		$compliance->coordinates = $request->coordinates;
		$compliance->catch_type = $request->catch_type;
		$compliance->date = $request->date;
		//$compliance->document_path = $document_name;
		$compliance->compliance = $request->compliance;
		
		$compliance->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Kepatuhan & Pelanggaran berhasil diubah',
        ]);
    }

    public function destroy(\App\Models\ComplianceViolation $compliance){
        if($compliance->document_path != ''){
            $filePath = public_path('uploads/compliance/' . $compliance->document_path);
            if(file_exists($filePath)){
                unlink($filePath);
            }
        }

        $compliance->delete();
        return redirect()->route('compliance.index')->with('success', 'Data berhasil dihapus');
    }
}