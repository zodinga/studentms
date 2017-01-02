<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Document;
use App\Student;
use Image;

class DocumentController extends Controller
{
	/*public function __construct(){
		$this->middleware('auth');
	}*/

    public function show($id){
    	$student=Student::findorfail($id);
    	return view('documents.show')->withStudent($student);
    }

    public function documentUpload(Request $request){
    	//dd('ddd');
        $file=$request->file('file');
        $filename=$request->input('student_id').'_'.uniqid().'_'.$file->getClientOriginalName();

        if(!file_exists('documents'))
            mkdir('documents',0777,true);

        if(!file_exists('documents/thumbs'))
            mkdir('documents/thumbs',0777,true);

        $file->move('documents',$filename);

        $thumb=Image::make('documents/'.$filename)->resize(240,160)->save('documents/thumbs/'.$filename,50);

        $student=Student::find($request->input('student_id'));

        $image=$student->documents()->create([
            'student_id'=>$request->input('student_id'),
            //'doc_name'=>$filename,
            'file_name'=>$filename,
            ]);
        return $image;
    }

    public function edit($id){
    	$document=Document::find($id);
    	return view('documents.edit')->withDocument($document);
    }

    public function update(Request $request){

    	$document=Document::find($request->id);

    	if($request->hasFile('file')){
    		$file=$request->file('file');
	        $filename=$request->input('student_id').'_'.uniqid().'_'.$file->getClientOriginalName();

	        if(!file_exists('documents'))
	            mkdir('documents',0777,true);

	        if(!file_exists('documents/thumbs'))
	            mkdir('documents/thumbs',0777,true);

	        $file->move('documents',$filename);

	        $thumb=Image::make('documents/'.$filename)->resize(240,160)->save('documents/thumbs/'.$filename,50);

	        $document->file_name=$filename;
    	}
        

        $document->doc_name=$request->doc_name;

        $document->save();

        $student=Student::find($document->student['id']);
        return view('documents.show')->withStudent($student);
    }

    public function destroy($id){
    	$document=Document::find($id);
    	$student=Student::find($document->student_id);
    	//Delete documents
            
        unlink(public_path('documents\\'.$document->file_name)); 
        unlink(public_path('documents\\thumbs\\'.$document->file_name)); 
        
        $document->delete();
        
        return view('documents.show')->withStudent($student);
    }

}
