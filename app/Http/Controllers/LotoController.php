<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loto;

class LotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('lotos.index');
    }
    public function cap3TinhLo(Request $request)
    {
        return view('hoikycap3.index');
    }
    public function cap3TinhLoPost(Request $request)
    {
        $lotos = [];
        if($request->date_start && $request->date_start){
            $from = $request->date_start;
            $to = $request->date_end;
            $lotos = Loto::whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        }
        
        $arr = [];
        foreach($lotos as $loto){
            $all_data =  json_decode($loto->all_data);
            foreach($all_data as $item){
                $arr[] = $item;
            }
        }
        // sort($arr);
        $result= [];
        for($i=0 ; $i<100; $i++){
            if (in_array($i, $arr))
            {
                
            } else {
                $result[] = $i;
            }
        }
        dd($result);

        dd($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lotos = [];
        if($request->date_start && $request->date_start){
            $from = $request->date_start;
            $to = $request->date_end;
            $lotos = Loto::whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        }
        $abc = [];
        $data = [];
        // dd($lotos);
        $detail = [];
        if(count($lotos)){
            foreach($lotos as $key => $item){
                if($key+1 <= count($lotos)){
                    $focus = json_decode($item->focus);
                    $all_data = json_decode($lotos[$key+1]->all_data);
                    if(count($focus)){
                        $total = array_sum($focus);
                        if($total < 100){
                            $total_1 = $total;
                            $total_2 = strrev((string)($total));
                            array_push($data,[$total_1,$total_2]);
                        } else {
                            $total1 = (string)($total);
                            $total_1 = $total1[0] . $total1[1];
                            $total_2 = $total1[1] . $total1[2];
                            array_push($data,[$total_1,$total_2]);
                        }
                        // dd($total_1,$total_2,$data,$all_data);
                        // dd($all_data);
                        $detail_12 = [];

                        foreach($all_data as $item1){
                            if($item1 == $total_1 || $item1==$total_2){
                                $abc[] = $item1;
                                $detail_12[] = $item1;
                            }
                        }
                    }
                }
                $detail2['so_1'] = $total_1;
                $detail2['so_2'] = $total_2;
                $detail2['data'] = $detail_12;
                $detail2['date'] = $item->date;
                array_push($detail,$detail2);
            }
        }
        return \response()->json([
            'data'=> $detail
        ]);
        dd($detail);
        dd($abc,count($data),$data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
