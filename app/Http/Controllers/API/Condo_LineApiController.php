<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Mylog_condo;
use App\Models\Condo_LineMessagingAPI;
use App\Models\Group_line;
use App\Models\Sos_map;
use App\Models\Partner;
use App\Models\Partner_condo;
use App\User;
use App\Models\User_condo;

class Condo_LineApiController extends Controller
{
    public function store(Request $request)
	{
        //SAVE LOG
        $requestData = $request->all();

        //GET ONLY FIRST EVENT
        $event = $requestData["events"][0];
        $condo_id = $requestData["condo_id"];

        $data = [
            "title" => "LINE INPUT",
            "content" => json_encode($requestData, JSON_UNESCAPED_UNICODE),
            "condo_id" => $condo_id,
        ];
        Mylog_condo::create($data);  

        switch($event["type"]){
            case "message" : 
                $this->messageHandler($event , $condo_id);
                break;
            case "postback" : 
                $this->postbackHandler($event , $condo_id);
                break;
            case "join" :
                $this->save_group_line($event , $condo_id);
                break;
            case "follow" :
                // SET RICH MENU LINE
                $this->set_richmanu_language($event["source"]['userId'], $condo_id);
                break;
        }
	}

	public function messageHandler($event , $condo_id)
    {
        switch($event["message"]["type"]){
            case "text" : 
                $this->textHandler($event , $condo_id);
                break;
        } 

    }

    public function postbackHandler($event , $condo_id)
    {
        $line_condo = new Condo_LineMessagingAPI();

        $data_postback_explode = explode("?",$event["postback"]["data"]);
        $data_postback = $data_postback_explode[0] ;

        switch($data_postback){
            case "notify_repair" :  
                $line_condo->postback_notify_repair($data_postback_explode[1], $event, $condo_id);
                break;
        }  

    }

    public function textHandler($event , $condo_id)
    {
        $line_condo = new Condo_LineMessagingAPI();

        switch( $event["message"]["text"] )
        {     
            case "สวัสดีครับ" :  
                $line_condo->replyToUser($event , $condo_id , "hello");
                break;
            // case "ข่าวสาร" :  
            //     $line_condo->replyToUser(null, $event, "vnews");
            //     break;
        }   

    }

    public function set_richmanu_language($provider_id, $condo_id)
    {
        $data_user = User::where('provider_id' , $provider_id)->first();
        $user_condos = User_condo::where('user_id' , $data_user->id)->where('condo_id' , $condo_id)->first();
        $data_condos = Partner_condo::where('id' , $condo_id)->first();

        $rich_menu_language = $user_condos->rich_menu_language ;

        switch ($rich_menu_language) {
            case 'th':
                $richMenuId = $data_condos->rich_menu_TH ;
                break;
            case 'en':
                $richMenuId = $data_condos->rich_menu_EN ;
                break;
            case 'zh-TW':
                $richMenuId = $data_condos->rich_menu_zh_TW ;
                break;
            case 'zh-CN':
                $richMenuId = $data_condos->rich_menu_zh_CN ;
                break;
        }

        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($data_condos->channel_access_token);
        $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $data_condos->channel_secret]);
        $response = $bot->linkRichMenu($provider_id, $richMenuId);

        $data = [
            "title" => "set_richmanu_" . $rich_menu_language,
            "content" => $provider_id . " / " . $data_user->name . "(" . $data_user->id . ")",
            "condo_id" => $data_condos->id,
        ];
        Mylog_condo::create($data);
    }

    public function save_group_line($event , $condo_id)
    {
        $data_condo = Partner_condo::where('id' , $condo_id)->first();
        $data_partner_of_condo = Partner::where('condo_id' , $condo_id)->where('name_area' , null)->first();

        $opts = [
            'http' =>[
                'method'  => 'GET',
                'header'  => "Content-Type: application/json \r\n".
                            'Authorization: Bearer '. $data_condo->channel_access_token,
            ]
        ];

        $group_id = $event['source']['groupId'];

        $context  = stream_context_create($opts);
        $url = "https://api.line.me/v2/bot/group/".$group_id."/summary";
        $result = file_get_contents($url, false, $context);

        $data_group_line = json_decode($result);

        $save_name_group = [
            "groupId" => $data_group_line->groupId,
            "groupName" => $data_group_line->groupName,
            "pictureUrl" => $data_group_line->pictureUrl,
            "owner" => $data_partner_of_condo->name . " (Partner)",
            "time_zone" => "Asia/Bangkok",
            "language" => "en",
            "partner_id" => $data_partner_of_condo->id,
            "condo_id" => $condo_id,
        ];
        
        Group_line::firstOrCreate($save_name_group);

        $data = [
            "title" => "บันทึก Name Group Line CONDO",
            "content" => $data_group_line->groupName,
            "condo_id" => $condo_id,
        ];
        Mylog_condo::create($data);

        $line_condo = new Condo_LineMessagingAPI();
        $line_condo->send_HelloLinegroup($event,$save_name_group);

    }

}
