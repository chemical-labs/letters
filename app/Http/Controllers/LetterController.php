<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\CursorPaginator;

use App\Models\Users;
use App\Models\Template;
use App\Models\Inbox;
use App\Models\Role;
use App\Models\Notify;
use App\Models\CustomTemplate;
use App\Models\CustomLetters;
use App\Models\MyLetters;

use Barryvdh\DomPDF\Facade as PDF;


class LetterController extends Controller
{
    public function index(Request $user){
        if(!$user->session()->get('role')){
            return back();
        }else{
            return view('letters.index', ['notify' => Notify::all()]);
        }
    }

    public function custom(Request $user){
        if(!$user->session()->get('role')){
            return back();
        }else{
            return view('letters.letters', ['notify' => Notify::all()]);
        }
    }

    public function custom_template(Request $user){
        if(!$user->session()->get('role')){
            return back();
        }else{
            return view('letters.custom_template', [
                'notify' => Notify::all(),
            ]);
        }
    }

    public function template_create(Request $user){
        if(!$user->session()->get('role')){
            return back();
        }else{

                CustomTemplate::insert([
                    'from' => $user->session()->get('firstname').' '.$user->session()->get('lastname'),
                    'title' => $user->title,
                    'date' => Date('d').'-'.Date('m').'-'.Date('Y'),
                    'tone' => $user->tone,
                    'address' => $user->address,
                    'contact' => $user->contact,
                    'icons' =>  'none.png',
                    'body' => $user->body,
                    'tanggal' => $user->tanggal_surat == 'yes' ? true : false,
                    'nomor_surat' => $user->nomor_surat == 'yes' ? true : false,
                    'perihal' => $user->perihal == 'yes' ? true : false,
                    'tujuan' => $user->tujuan == 'yes' ? true : false,
                    'salam_pembuka' => $user->salam_pembuka == 'yes' ? true : false,
                    'penutup' => $user->penutup == 'yes' ? true : false,
                    'ttd' => $user->ttd == 'yes' ? true : false,
                    'tembusan' => $user->tembusan == 'yes' ? true : false
                ]);

                $data = CustomTemplate::where('title', $user->title)->first();

                Notify::insert([
                    'title' => 'Template baru : '.$user->title,
                    'body' => route('overview-letter', ['id' => $data->id, 'type' => 'template']),
                    'desc' => 'Template baru dari '.$user->session()->get('firstname')
                ]);
                return back();

        }
    }

    public function custom_new(Request $user){
        if(!$user->session()->get('role')){
            return back();
        }else{
            $data = CustomTemplate::paginate(10);
            return view('letters.letters-new', [
                'notify' => Notify::all(),
                'template' => $data,
            ]);
        }
    }

    public function template_input(Request $user, $id){
        if(!$user->session()->get('role')){
            return back();
        }else{
            $data = CustomTemplate::where('id', $id)->first();
            return view('letters.custom_template_input', [
                'notify' => Notify::all(),
                'data' => $data
            ]);
        }
    }

    public function send(Request $user){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            return view('letters.send', ['role' => Role::all(), 'notify' => Notify::all()]);
        }
    }

    public function send_post(Request $data){
        if(!$data->session()->get('firstname')){
            return back();
        }else{
            Inbox::insert([
                'subject' => $data->subject,
                'from' => $data->session()->get('firstname'),
                'body' => $data->body,
                'role' => $data->role,
                'letter' => 'none.pdf',
                'date' => date('D-M-Y')
            ]);

            return back()->with('done', 'done');
        }
    }

    public function my_letters(Request $user){
        if(!$user->session()->get('role')){
            return back();
        }else{
            $data = MyLetters::where('from', $user->session()->get('email'))->get();
            return view('letters.letters-dump', [
                'notify' => Notify::all(),
                'data' => $data
            ]);
        }
    }

    public function my_letter_delete(Request $user, $id){
        if(!$user->session()->get('role')){
            return back();
        }else{
            try{
                MyLetters::where('id', $id)->where('from', $user->session()->get('email'))->delete();
                return back();
            }catch(\Exception $e){
                return back()->with('error', 'error');
            }
        }
    }

    public function my_letters_render(Request $user, $id){
        if(!$user->session()->get('role')){
            return back();
        }else{
            $data = MyLetters::where('id', $id)->first();
            $pdf_data = PDF::setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])->loadView('letters-template.template', [
                'title' => $data->title,
                'address' => $data->address,
                'icons' => $data->icons,
                'body' => $data->body,
                'contact' => $data->contact,
                'tone' => $data->tone,
                'nomor_surat' => $data->nomor_surat,
                'perihal' => $data->perihal,
                'tanggal' => $data->tanggal,
                'salam_pembuka' => $data->salam_pembuka,
                'penutup' => $data->penutup,
                'ttd' => $data->ttd,
                'tembusan' => $data->tembusan,
                'overview' => false
            ]);

            return $pdf_data->stream();
        }
    }

    public function create_custom_letters(Request $user, $id){
        if(!$user->session()->get('role')){
            return back();
        }else{
            try{
                $data = CustomTemplate::where('id', $id)->first();
                MyLetters::insert([
                    'from' => $user->session()->get('email'),
                    'date' => Date('d').'-'.Date('m').'-'.Date('Y'),
                    'title' => $data->title,
                    'icons' => $data->icons,
                    'address' => $data->address,
                    'contact' => $data->contact,
                    'name' => $user->name,
                    'tanggal' => $user->tanggal,
                    'body' => $data->body,
                    'nomor_surat' => $user->nomor_surat,
                    'perihal' => $user->perihal,
                    'tujuan' => $user->tujuan,
                    'salam_pembuka' => $user->salam_pembuka,
                    'penutup' => $user->penutup,
                    'ttd' => $user->ttd,
                    'tembusan' => $user->tembusan
                ]);
                return back();
            }catch(\Exception $e){
                return back();
            }
        }
    }

    public function inbox(Request $user){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            if($user->session()->get('level') == 'admin'){
                return view('letters.inbox', ['inbox' => Inbox::all(), 'notify' => Notify::all()]);
            }else{
                return view('letters.inbox', ['inbox' => Inbox::where('role', $user->session()->get('role'))->get(), 'notify' => Notify::all()]);
            }
        }
    }

    public function inbox_overview(Request $user, $id){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            $data = Inbox::where('id', $id)->first();
            return view('letters.inbox_overview', ["data" => $data, 'notify' => Notify::all()]);
        }
    }

    public function inbox_delete(Request $user, $id){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            Inbox::where('id', $id)->delete();
            return redirect()->route('inbox-letter');
        }
    }

    public function search(Request $data){
        if(!$data->session()->get('role')){
            return back();
        }else{
            $query = CustomTemplate::where('title', 'like', '%'.$data->search.'%')->get();
            return view('letters.search', ['data' => $query, 'notify' => Notify::all()]);
        }
    }

    public function create(Request $data){
        if($data->file('cover')){
            $file = $data->file('cover');
            $file->move('./uploads/temp/', $file->getClientOriginalName());
        }

        $check = Template::where('title', $data->title)->count();
        if($check > 0){
            return back()->with('already', 'already');
        }else{
            try{
                Template::insert([
                    'creator' => $data->session()->get('firstname'),
                    'title' => $data->title,
                    'desc' => $data->desc,
                    'address' => $data->alamat,
                    'banner' => $data->file('cover') ? url('/').'/uploads/temp/'.$file->getClientOriginalName() : 'none.png',
                    'tone_title' => $data->tone_title,
                    'body' => $data->body,
                    'date' => date('d-m-y')
                ]);

                $get = Template::where('title', $data->title)->first();

                Notify::insert([
                    'title' => 'Template baru : '.$data->title,
                    'body' => route('overview-letter', $get->id),
                    'desc' => 'Template baru dari '.$data->session()->get('firstname')
                ]);

                return back()->with('success', 'success');
            }catch(\Exception $e){
                if($e){
                    $pdf_data = PDF::setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])->loadView('letters-template.custom', [
                        'banner' => $data->banner,
                        'title' => $data->title,
                        'tone_title' => $data->tone_title,
                        'alamat' => $data->address,
                        'desc' => $data->desc,
                        'body' => $data->body,
                    ]);
                    return $pdf_data->stream();
                }
            }
        }
    }

    public function render(Request $user){
        $pdf_data = PDF::setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])->loadView('letters-template.template');
        return $pdf_data->stream();
    }

    public function template(Request $user){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            if($user->template == null){
                $data = Template::all();
                return view('letters.template',  ['data' => $data, 'notify' => Notify::all(), 'mode' => 'fully_custom']);
            }else if($user->template == 'fully_custom'){
                $data = Template::all();
                return view('letters.template',  ['data' => $data, 'notify' => Notify::all(), 'mode' => 'fully_custom']);
            }else if($user->template == 'template'){
                $data = CustomTemplate::all();
                return view('letters.template',  ['data' => $data, 'notify' => Notify::all(), 'mode' => 'template']);
            }
        }
    }

    public function overview(Request $user, $id, $type){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            if($type == null ){
                $data = Template::where('id', $id)->first();
                $pdf_data = PDF::setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])->loadView('letters-template.custom', [
                    'banner' => $data->banner,
                    'title' => $data->title,
                    'tone_title' => $data->tone_title,
                    'alamat' => $data->address,
                    'desc' => $data->desc,
                    'body' => $data->body,
                ]);
                return $pdf_data->stream();
            }else if($type == 'fully_custom'){
                $data = Template::where('id', $id)->first();
                $pdf_data = PDF::setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])->loadView('letters-template.custom', [
                    'banner' => $data->banner,
                    'title' => $data->title,
                    'tone_title' => $data->tone_title,
                    'alamat' => $data->address,
                    'desc' => $data->desc,
                    'body' => $data->body,
                ]);
                return $pdf_data->stream();
            }else if($type == 'template'){
                $data = CustomTemplate::where('id', $id)->first();
                $pdf_data = PDF::setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true])->loadView('letters-template.template', [
                    'title' => $data->title,
                    'address' => $data->address,
                    'icons' => $data->icons,
                    'body' => $data->body,
                    'contact' => $data->contact,
                    'tone' => $data->tone,
                    'nomor_surat' => $data->nomor_surat,
                    'perihal' => $data->perihal,
                    'tanggal' => $data->tanggal,
                    'salam_pembuka' => $data->salam_pembuka,
                    'penutup' => $data->penutup,
                    'ttd' => $data->ttd,
                    'tembusan' => $data->tembusan,
                    'overview' => true
                ]);

                return $pdf_data->stream();
            }
        }
    }

    public function delete(Request $user, $id){
        if(!$user->session()->get('firstname')){
            return back();
        }else{
            $data = Template::where('id', $id)->first();
            Notify::where('title', 'Template baru : '.$data->title)->delete();
            Template::where('id', $id)->delete();
            return back()->with('done', 'done');
        }
    }
}
