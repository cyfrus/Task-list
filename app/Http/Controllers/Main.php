<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class Main extends Controller
{
    //
    private $jezik = "";

    public function __construct()
    {
        $path = public_path().'/jezik.txt';
        $this->jezik = file_get_contents($path);
    }

    public function home()
    {
    	$zadaci = DB::table("zadaci")->get();
        $count = DB::table('zadaci')->count();
        $solved = DB::table('zadaci')->where('status','=',1)->count();
        $unsolved = DB::table('zadaci')->where('status','=',0)->count();
    	return view('main',['zadaci'=> $zadaci,'count'=> $count,'solved'=> $solved,'unsolved'=> $unsolved,'jezik'=>$this->getLanguage($this->jezik)]); 
    }

    function getLanguage($lang)
    {
        $english = ['main_title' => 'title', 'add_task'=> 'Add Task', 'language' => 'Language', 'task_list'=> 'List of tasks', 'open'=> 'Open', 'title'=> 'Title', 'status'=> 'Status', 'opendate'=> 'Time and date of opening', 'exec_time'=> 'Date of execution', 'del' => 'Delete', 'solved_tasks'=> 'Solved tasks', 'unsolved'=> 'Unsolved tasks','total_tasks'=> 'Total number of tasks','not_opened' => 'Not opened','not_openedb' => 'Not opened before','not_finished' => 'Not finished','croatian'=> 'Croatian','english' => 'English','desc'=> 'Description', 'add'=> 'Add Task','mark_as_finished'=> "Mark as finished",'mark_as_unfinished'=> 'Mark as unfinished'];

        $croatian = ['main_title' => 'title', 'add_task'=> 'Dodaj zadatak', 'language' => 'Jezik', 'task_list'=> 'Lista zadataka', 'open'=> 'Otvori', 'title'=> 'Naslov', 'status'=> 'Status', 'opendate'=> 'Vrijeme i datum otvaranja', 'exec_time'=> 'Datum izvršenja', 'del' => 'Izbriši', 'solved_tasks'=> 'Riješeni zadaci', 'unsolved'=> 'Neriješeni zadaci','total_tasks'=> 'Ukupno zadataka','not_opened' => 'Nije otvoren','not_openedb' => 'Nije prethodno otvaran','not_finished' => 'Nezavršen','croatian'=> 'Hrvatski','english' => 'Engleski','desc'=> 'Opis', 'add'=> 'Dodaj zadatak','mark_as_finished'=> "Oznaci kao završen",'mark_as_unfinished'=> 'Označi kao nezavršen'];

        if($lang == "english")
        {
            return $english;
        }
        if($lang == "croatian")
        {
            return $croatian;
        }
    }

    public function changeLanguage($lang)
    {
        $path = public_path().'/jezik.txt';
        file_put_contents($path, "");
        if($lang == "english" || $lang == "croatian")
        file_put_contents($path, $lang);
        else
        file_put_contents($path,'english');
        return back();
    }

    public function add()
    {
    	return view('add_zadatak',['jezik'=>$this->getLanguage($this->jezik)]);
    }

    public function insert(Request $request)
    {

    	$naslov = $request->input('naslov');
    	$opis = $request->input('opis');
    	$status = 0;
        $exists = DB::table('zadaci')->where('naslov','=',$naslov)->count();
        if($exists)
        {
            return view('add_zadatak',['error' => true,'naslov'=> $naslov]);
        }
    	DB::table("zadaci")->insert(
    		['naslov'=> $naslov,'opis_zadatka'=> $opis, 'status'=> $status]	
    	);
        return redirect()->route('home');
    }

    public function showTask($id)
    {
        $zadatak = DB::table('zadaci')->where('id','=',$id)->get();
        DB::table('zadaci')->where('id','=',$id)->update(['vrijeme_otvaranja'=> date('Y-m-d H:i:s')]);
        return view('show_zadatak',['zadatak'=>$zadatak[0],'jezik'=>$this->getLanguage($this->jezik)]);
    }

    public function finishTask($id)
    {
        DB::table('zadaci')
                    ->where('id','=',$id)
                    ->update(['datum_zavrsetka' => date('Y-m-d'),'status'=> 1]);

        return redirect()->route('showTask',$id);
    }

    public function openTask($id)
    {
        DB::table('zadaci')->where('id','=',$id)->update(['status'=> 0,'datum_zavrsetka'=> '0000-00-00']);
        return redirect()->route('showTask',$id);
    }

    public function deleteTask(Request $request)
    {
        DB::table('zadaci')->where('id','=',$request->input('id'))->delete();
         return redirect()->route('home');
    }
}
