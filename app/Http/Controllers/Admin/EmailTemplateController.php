<?php

namespace App\Http\Controllers\Admin;

use App\Model\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailTemplateController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = EmailTemplate::all();

        return view('admin.emails.templates',compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.emails.create_templates');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'subject' => 'required:min:3',
            'description' => 'required|min:10',
            'macros' => 'min:5',
        ]);
        $data = [
            'name'=>$request->name,
            'subject'=>$request->subject,
            'description'=>$request->description,
            'macros'=>$request->macros,
        ];

        $emailTemplate = EmailTemplate::create($data);
        if($emailTemplate)
        {
            return redirect()->route('admin.email.templates.index');
        }
        return abort(500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = EmailTemplate::where('id',$id)->firstOrFail();
        return view('admin.emails.template_view',compact('template'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function row($id)
    {
        $template = EmailTemplate::where('id',$id)->firstOrFail();
        return $template->description;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = EmailTemplate::where('id',$id)->firstOrFail();
        return view('admin.emails.template_edit',compact('template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'subject' => 'required:min:3',
            'description' => 'required|min:10',
            'macros' => 'min:5',
        ]);
        $template = EmailTemplate::where('id',$id)->firstOrFail();
        $template->name = $request->name;
        $template->subject = $request->subject;
        $template->description = $request->description;
        $template->macros = $request->macros;
        $template->save();

        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
