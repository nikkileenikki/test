<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Helper extends Model
{
   function getPaginate($paginate){
      $current_page = $paginate->currentPage();
      $from = $paginate->firstItem();
      $first_page_url = $paginate->url(1);
      $last_page = $paginate->lastPage();
      $last_page_url = $paginate->url($last_page);
      $next_page_url = $paginate->nextPageUrl();
      $path = $paginate->url($current_page);
      $per_page = $paginate->count();
      $prev_page_url = $paginate->previousPageUrl();
      $to = $paginate->lastItem();
      $total = $paginate->total();

      $response = [
         'data'=> [],
         'current_page' => $current_page,
         'first_page_url' => isset($first_page_url) ? $first_page_url.'&paginate='.$per_page: null,
         'from' => $from,
         'last_page' => $last_page,
         'last_page_url' => isset($last_page_url) ? $last_page_url.'&paginate='.$per_page: null,
         'next_page_url' => isset($next_page_url) ? $next_page_url.'&paginate='.$per_page: null,
         'path' => $path.'&paginate='.$per_page,
         'per_page' => $per_page,
         'prev_page_url' => isset($prev_page_url) ? $prev_page_url.'&paginate='.$per_page: null,
         'to' => $to,
         'total' => $total,
      ];
      return $response;
   }

   function getSuccess($key, $value, $array){
      $now = Carbon::now('Asia/Kuala_Lumpur')->toDateTimeString();
      $action = "created";
      
      if(isset($array["updated_at"])){
         $updateTime = $array["updated_at"];
         $createTime = $array["created_at"];
         $deleteTime = $array["deleted_at"];
      }else{
         $updateTime = $array[0]["updated_at"];
         $createTime = $array[0]["created_at"];
         $deleteTime = $array[0]["deleted_at"];
      }

      if($now>$createTime ){
         $action = "updated";
      }
      if($deleteTime){
         $action = "deleted";
      }
      $data['data']= [
         $action => $now,
         $key => $value
      ];

      $data['data']['column'] = $array;
      return $data;
   }

   function errorCode($code){
      switch ($code) {
         case 200:
            $status = 'OK';
            $description = 'The request was successfully completed.';
            break;
         case 201:
            $status = 'Created';
            $description = 'A new resource was successfully created.';
            break;
         case 204:
            $status = 'No Content';
            $description = 'The server successfully processed the request, but is not returning any content.';
            break;
         case 400:
            $status = 'Bad Request';
            $description = 'The request was invalid.';
            break;
         case 401:
            $status = 'Unauthorized';
            $description = 'The request did not include an authentication token or the authentication token was expired.';
            break;
         case 403:
            $status = 'Forbidden';
            $description = 'The client did not have permission to access the requested resource.';
            break;
         case 404:
            $status = 'Not Found';
            $description = 'The requested resource was not found.';
            break;
         case 405:
            $status = 'Method Not Allowed';
            $description = 'The HTTP method in the request was not supported by the resource. For example, the DELETE method cannot be used with the Agent API.';
            break;
         case 409:
            $status = 'Conflict';
            $description = 'The request could not be completed due to a conflict. For example,  POST ContentStore Folder API cannot complete if the given file or folder name already exists in the parent location.';
            break;
         case 500:
            $status = 'Internal Server Error';
            $description = 'The request was not completed due to an internal error on the server side.';
            break;
         case 503:
            $status = 'Service Unavailable';
            $description = 'The server was unavailable.';
            break;
         default:
            $status = 'Error code not found';
     }
      $data['error']['errors'] = [
          'code' => $code,
          'status' => $status,
          'description' => $description
      ];
      return $data;
  }
  
   function getReadRules(){
      $rules =  [
         'id' => 'string',
         'label' => 'string',
         'model' => 'string',
         'sn' => 'string',
         'status' => 'in:available,occupied,0,1',
         'remark' => 'string',
         'warranty' => 'date',
         'slot' => 'string',
         'zone' => 'string',
         'server_id' => 'string',
         'filter' => 'string',
         'sort' => 'in:asc,desc',
         'deleted' => 'string',

         'client_name' => 'string',
         'client_email' => 'string',
         'client_company' => 'string',
         'client_contact' => 'string',
         'client_wechat' => 'string',
         'client_qq' => 'string',
         'client_skype' => 'string',
         'client_tier' => 'string',
         'client_company_contact' => 'string',
         'client_company_address' => 'string',
         'client_country' => 'string',

         'socket' => 'string',
         'clockspeed' => 'string',
         'cores' => 'string',

         'type' => 'string',
         'key' => 'string',
         'value' => 'string',

         'pdu_id' => 'string',
         'rack_id' => 'string',

         'capacity' => 'string',
         'unit' => 'string',

         'plug' => 'string',
         'current' => 'string',
         'load' => 'string',

         'name' => 'string',
         'product_name' => 'string',

         'inventory' => 'string',
         'client' => 'string',

         'capacity' => 'string',
         'unit' => 'string',

         'firewall_id' => 'string',
         'switch_id' => 'string',
         'task_id' => 'string',
         'ip' => 'string',

         'port' => 'string',
         'ethernet' => 'string',
      ];
      return $rules;
   }

   function getUpdateRules(){
      $rules =  [
         'card_model' => 'string',
         'card_status' => 'in:available,occupied,0,1',
         'card_slot_type' => 'string',
         'card_warranty' => 'date',

         'client_email' => 'string',

         'cpu_model' => 'string',
         'cpu_status' => 'in:available,occupied,0,1',
         'cpu_socket_type' => 'string',
         'cpu_clockspeed' => 'string',
         'cpu_cores' => 'string',
         'cpu_warranty' => 'date',

         'key' => 'string',

         'firewall_model' => 'string',
         'firewall_status' => 'in:available,occupied,0,1',
         'firewall_warranty' => 'date',

         'hdd_model' => 'string',
         'hdd_status' => 'in:available,occupied,0,1',
         'hdd_warranty' => 'date',
         'hdd_capacity' => 'integer',

         'pdu_model' => 'string',
         'pdu_status' => 'in:available,occupied,0,1',
         'pdu_warranty' => 'date',

         'ram_model' => 'string',
         //'ram_status' => 'in:available,occupied,0,1',
         'ram_warranty' => 'date',

         'server_model' => 'string',
         'server_status' => 'in:available,occupied,0,1',
         'server_warranty' => 'date',

         'switch_model' => 'string',
         'switch_status' => 'in:available,occupied,0,1',
         'switch_warranty' => 'date',
     ];
      return $rules;
   }
}