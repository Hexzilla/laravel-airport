<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiNewsController extends Controller
{
    public function index(){
        $resultRQ = array();
        $resultRQ['api_http'] = 500;
        $resultRQ['api_status'] = "KO";
        $resultRQ['api_message'] = "No News for this dates!";

        if($_GET['date_from'] == null || $_GET['date_until']==null )
        {
            $resultRQ['api_http']=401;
            $resultRQ['api_message'] = "MIssing parameters";
            //echo json_encode($resultRQ, JSON_PRETTY_PRINT);
            $result= $resultRQ;
        }
        else
        {
            $result['news'] = DB::table('som_news')
                ->whereBetween('som_news.date_from',[$_GET['date_from'],$_GET['date_until']])
                ->orWhereBetween('som_news.date_until',[$_GET['date_from'],$_GET['date_until']])
                ->select(
                    'som_news.id AS id',
                    'som_news.title AS title',
                    'som_news.news_description AS news_description',
                    'som_news.date_from AS date_from',
                    'som_news.date_until AS date_until')
                ->get();

            $resultRQ['api_http']=200;
            $resultRQ['api_status'] = "OK";
            $resultRQ['api_message'] = "";
            #$resultRQ['date1']=$postdata['date_from'];
            #$resultRQ['date2']=$postdata['date_until'];
            $resultRQ['data'] = $result;
            $result= $resultRQ;
        }
        return json_encode($result);
    }
}
