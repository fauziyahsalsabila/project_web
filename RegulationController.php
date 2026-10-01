<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regulation;

class RegulationController extends Controller
{
    public function document(string $filename)
    {
        $filePath = public_path('uploads/regulation/' . basename($filename));

        abort_unless(is_file($filePath), 404);

        return response()->file($filePath);
    }

    public function index(Request $request){
        $regulation = \App\Models\Regulation::orderBy('created_at', 'desc')
            ->get();

        return view('sailor.regulation.index', compact('regulation'));
    }

    public function homeIndex(Request $request){
        $regulation = \App\Models\Regulation::orderBy('created_at', 'desc');

        if($request->has('search'))
            $regulation = $regulation->where('name', 'like', '%' . $request->search . '%');
                
        $regulation = $regulation->get();

        return view('sailor.home.regulation', compact('regulation', 'request'));
    }

    public function store(Request $request){
        $document_name = '';

        if($request->hasFile('document')){
            $document = $request->file('document');
            $document_name = time() . '_' . $document->getClientOriginalName();
            $document->move('uploads/regulation/', $document_name);
        }

		$regulation = new \App\Models\Regulation;

		$regulation->name = $request->name;        
        $regulation->document_path = $document_name;
        $regulation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Peraturan berhasil disimpan',
        ]);
    }

    public function destroy(Regulation $regulation)
    {
        if ($regulation->document_path) {
            $filePath = public_path('uploads/regulations/' . $regulation->document_path);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $regulation->delete();

        return redirect()->route('regulation.index')->with('success', 'Peraturan berhasil dihapus');
    }
}
