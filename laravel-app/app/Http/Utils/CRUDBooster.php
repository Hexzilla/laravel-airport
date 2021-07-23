<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class CRUDBooster
{
    public static function g($name)
    {
        return Request::get($name);
    }

    public static function getSetting($name)
    {
        if (Cache::has('setting_' . $name)) {
            return Cache::get('setting_' . $name);
        }

        $query = DB::table('cms_settings')->where('name', $name)->first();
        Cache::forever('setting_' . $name, $query->content);
        return $query->content;
    }

    public static function insert($table, $data = [])
    {
        if (array_key_exists('_token', $data)) {
            unset($data['_token']);
        }

        $data['id'] = DB::table($table)->max('id') + 1;
        if (array_key_exists('created_at', $data) && !$data['created_at']) {
            if (Schema::hasColumn($table, 'created_at')) {
                $data['created_at'] = date('Y-m-d H:i:s');
            }
        }

        if (DB::table($table)->insert($data)) return $data['id'];
        else return false;
    }

    public static function first($table, $id)
    {
        $table = self::parseSqlTable($table)['table'];
        if (is_array($id)) {
            $first = DB::table($table);
            foreach ($id as $k => $v) {
                $first->where($k, $v);
            }
            return $first->first();
        } else {
            $pk = self::pk($table);
            return DB::table($table)->where($pk, $id)->first();
        }
    }

    public static function get($table, $string_conditions = NULL, $orderby = NULL, $limit = NULL, $skip = NULL)
    {
        $table = self::parseSqlTable($table);
        $table = $table['table'];
        $query = DB::table($table);
        if ($string_conditions) $query->whereraw($string_conditions);
        if ($orderby) $query->orderbyraw($orderby);
        if ($limit) $query->take($limit);
        if ($skip) $query->skip($skip);
        return $query->get();
    }

    public static function me()
    {
        return DB::table(config('crudbooster.USER_TABLE'))->where('id', Session::get('admin_id'))->first();
    }

    public static function myId()
    {
        return Session::get('admin_id');
    }

    public static function isSuperadmin()
    {
        return Session::get('admin_is_superadmin');
    }

    public static function myName()
    {
        return Session::get('admin_name');
    }

    public static function myPhoto()
    {
        return Session::get('admin_photo');
    }

    public static function myPrivilege()
    {
        $roles = Session::get('admin_privileges_roles');
        if ($roles) {
            foreach ($roles as $role) {
                if ($role->path == CRUDBooster::getModulePath()) {
                    return $role;
                }
            }
        }
    }

    public static function myPrivilegeId()
    {
        return Session::get('admin_privileges');
    }

    public static function myPrivilegeName()
    {
        return Session::get('admin_privileges_name');
    }

    public static function isLocked()
    {
        return Session::get('admin_lock');
    }

    public static function redirect($to, $message, $type = 'warning')
    {

        if (Request::ajax()) {
            $resp = response()->json(['message' => $message, 'message_type' => $type, 'redirect_url' => $to])->send();
            exit;
        } else {
            $resp = redirect($to)->with(['message' => $message, 'message_type' => $type]);
            Session::driver()->save();
            $resp->send();
            exit;
        }
    }

    public static function isView()
    {
        if (self::isSuperadmin()) return true;
        $userSession = Auth::user();
        //var_dump($userSession);
        $session = Session::get('admin_privileges_roles');
        if ($userSession === null || $session === null || count($session) === 0 ) { return CRUDBooster::redirect('/login', 'User session not found...'); }
        foreach ($session as $v) {
            if ($v->path == self::getModulePath()) {
                return (bool) $v->is_visible;
            }
        }
    }

    public static function isUpdate()
    {
        if (self::isSuperadmin()) return true;

        $session = Session::get('admin_privileges_roles');
        if ($session === null || count($session) === 0 ) { return CRUDBooster::redirect('/login', 'Unauthorized'); }
        foreach ($session as $v) {
            if ($v->path == self::getModulePath()) {
                return (bool) $v->is_edit;
            }
        }
    }

    public static function isCreate()
    {
        if (self::isSuperadmin()) return true;

        $session = Session::get('admin_privileges_roles');
        if ($session === null || count($session) === 0 ) { return CRUDBooster::redirect('/login', 'Unauthorized'); }
        foreach ($session as $v) {
            if ($v->path == self::getModulePath()) {
                return (bool) $v->is_create;
            }
        }
    }

    public static function isRead()
    {
        if (self::isSuperadmin()) return true;

        $session = Session::get('admin_privileges_roles');
        if ($session === null || count($session) === 0 ) { return CRUDBooster::redirect('/login', 'Unauthorized'); }
        foreach ($session as $v) {
            if ($v->path == self::getModulePath()) {
                return (bool) $v->is_read;
            }
        }
    }

    public static function isDelete()
    {
        if (self::isSuperadmin()) return true;

        $session = Session::get('admin_privileges_roles');
        if ($session === null || count($session) === 0 ) { return CRUDBooster::redirect('/login', 'Unauthorized'); }
        foreach ($session as $v) {
            if ($v->path == self::getModulePath()) {
                return (bool) $v->is_delete;
            }
        }
    }

    public static function isCRUD()
    {
        if (self::isSuperadmin()) return true;

        $session = Session::get('admin_privileges_roles');
        if ($session === null || count($session) === 0 ) { return CRUDBooster::redirect('/login', 'Unauthorized'); }
        foreach ($session as $v) {
            if ($v->path == self::getModulePath()) {
                if ($v->is_visible && $v->is_create && $v->is_read && $v->is_edit && $v->is_delete) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }


    public static function getCurrentModule()
    {
        $modulepath = self::getModulePath();
        if (Cache::has('moduls_' . $modulepath)) {
            return Cache::get('moduls_' . $modulepath);
        } else {
            $module = DB::table('cms_moduls')->where('path', self::getModulePath())->first();
            return $module;
        }
    }

    public static function getCurrentDashboardId()
    {
        if (Request::get('d') != NULL) {
            Session::put('currentDashboardId', Request::get('d'));
            Session::put('currentMenuId', 0);
            return Request::get('d');
        } else {
            return Session::get('currentDashboardId');
        }
    }

    public static function getCurrentMenuId()
    {
        if (Request::get('m') != NULL) {
            Session::put('currentMenuId', Request::get('m'));
            Session::put('currentDashboardId', 0);
            return Request::get('m');
        } else {
            return Session::get('currentMenuId');
        }
    }

    public static function sidebarDashboard()
    {

        $menu = DB::table('cms_menus')
            ->whereRaw("cms_menus.id IN (select id_cms_menus from cms_menus_privileges where id_cms_privileges = '" . self::myPrivilegeId() . "')")
            ->where('is_dashboard', 1)
            ->where('is_active', 1)
            ->first();

        switch ($menu->type) {
            case 'Route':
                $url = route($menu->path);
                break;
            default:
            case 'URL':
                $url = $menu->path;
                break;
            case 'Controller & Method':
                $url = action($menu->path);
                break;
            case 'Module':
            case 'Statistic':
                $url = self::adminPath($menu->path);
                break;
        }

        @$menu->url = $url;

        return $menu;
    }

    public static function sidebarMenu()
    {
        $menu_active = DB::table('cms_menus')
            ->whereRaw("cms_menus.id IN (select id_cms_menus from cms_menus_privileges where id_cms_privileges = '" . self::myPrivilegeId() . "')")
            ->where('parent_id', 0)
            ->where('is_active', 1)
            ->where('is_dashboard', 0)
            ->orderby('sorting', 'asc')
            ->select('cms_menus.*')
            ->get();

        foreach ($menu_active as &$menu) {

            try {
                switch ($menu->type) {
                    case 'Route':
                        $url = route($menu->path);
                        break;
                    default:
                    case 'URL':
                        $url = $menu->path;
                        break;
                    case 'Controller & Method':
                        $url = action($menu->path);
                        break;
                    case 'Module':
                    case 'Statistic':
                        $url = self::adminPath($menu->path);
                        break;
                }

                $menu->is_broken = false;
            } catch (\Exception $e) {
                $url = "#";
                $menu->is_broken = true;
            }

            $menu->url = $url;
            $menu->url_path = trim(str_replace(url('/'), '', $url), "/");

            $child = DB::table('cms_menus')
                ->whereRaw("cms_menus.id IN (select id_cms_menus from cms_menus_privileges where id_cms_privileges = '" . self::myPrivilegeId() . "')")
                ->where('is_dashboard', 0)
                ->where('is_active', 1)
                ->where('parent_id', $menu->id)
                ->select('cms_menus.*')
                ->orderby('sorting', 'asc')->get();
            if (count($child)) {

                foreach ($child as &$c) {

                    try {
                        switch ($c->type) {
                            case 'Route':
                                $url = route($c->path);
                                break;
                            default:
                            case 'URL':
                                $url = $c->path;
                                break;
                            case 'Controller & Method':
                                $url = action($c->path);
                                break;
                            case 'Module':
                            case 'Statistic':
                                $url = self::adminPath($c->path);
                                break;
                        }
                        $c->is_broken = false;
                    } catch (\Exception $e) {
                        $url = "#";
                        $c->is_broken = true;
                    }

                    $c->url = $url;
                    $c->url_path = trim(str_replace(url('/'), '', $url), "/");
                }

                $menu->children = $child;
            }
        }

        return $menu_active;
    }

    public static function deleteConfirm($redirectTo)
    {
        echo "swal({
				title: \"" . trans('crudbooster.delete_title_confirm') . "\",
				text: \"" . trans('crudbooster.delete_description_confirm') . "\",
				type: \"warning\",
				showCancelButton: true,
				confirmButtonColor: \"#ff0000\",
				confirmButtonText: \"" . trans('crudbooster.confirmation_yes') . "\",
				cancelButtonText: \"" . trans('crudbooster.confirmation_no') . "\",
				closeOnConfirm: false },
				function(){  location.href=\"$redirectTo\" });";
    }

    private static function getModulePath()
    {
        // Changed for database log.
        // $adminPathSegments = count(explode('/', config('crudbooster.ADMIN_PATH')));
        // return Request::segment(1 + $adminPathSegments);
        return Request::segment(1);
    }

    public static function mainpath($path = NULL)
    {

        $controllername = str_replace(["\crocodicstudio\crudbooster\controllers\\", "App\Http\Controllers\\"], "", strtok(Route::currentRouteAction(), '@'));
        $route_url = route($controllername . 'GetIndex');

        if ($path) {
            if (substr($path, 0, 1) == '?') {
                return trim($route_url, '/') . $path;
            } else {
                return $route_url . '/' . $path;
            }
        } else {
            return trim($route_url, '/');
        }
    }

    public static function adminPath($path = NULL)
    {
        return url(config('crudbooster.ADMIN_PATH') . '/' . $path);
    }

    public static function getCurrentId()
    {
        $id = Session::get('current_row_id');
        $id = intval($id);
        $id = (!$id) ? Request::segment(4) : $id;
        $id = intval($id);
        return $id;
    }

    public static function getCurrentMethod()
    {
        $action = str_replace("App\Http\Controllers", "", Route::currentRouteAction());
        $atloc = strpos($action, '@') + 1;
        $method = substr($action, $atloc);
        return $method;
    }

    public static function clearCache($name)
    {
        if (Cache::forget($name)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isColumnNULL($table, $field)
    {
        if (Cache::has('field_isNull_' . $table . '_' . $field)) {
            return Cache::get('field_isNull_' . $table . '_' . $field);
        }

        try {
            //MySQL & SQL Server
            $isNULL = DB::select(DB::raw("select IS_NULLABLE from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$table' and COLUMN_NAME = '$field'"))[0]->IS_NULLABLE;
            $isNULL = ($isNULL == 'YES') ? TRUE : FALSE;
            Cache::forever('field_isNull_' . $table . '_' . $field, $isNULL);
        } catch (\Exception $e) {
            $isNULL = false;
            Cache::forever('field_isNull_' . $table . '_' . $field, $isNULL);
        }
        return $isNULL;
    }

    public static function getFieldType($table, $field)
    {
        if (Cache::has('field_type_' . $table . '_' . $field)) {
            return Cache::get('field_type_' . $table . '_' . $field);
        }

        $typedata = Cache::rememberForever('field_type_' . $table . '_' . $field, function () use ($table, $field) {

            try {
                //MySQL & SQL Server
                $typedata = DB::select(DB::raw("select DATA_TYPE from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$table' and COLUMN_NAME = '$field'"))[0]->DATA_TYPE;
            } catch (\Exception $e) {
            }

            if (!$typedata) $typedata = 'varchar';

            return $typedata;
        });

        return $typedata;
    }

    public static function getValueFilter($field)
    {
        $filter = Request::get('filter_column');
        if ($filter[$field]) {
            return $filter[$field]['value'];
        }
    }

    public static function getSortingFilter($field)
    {
        $filter = Request::get('filter_column');
        if ($filter[$field]) {
            return $filter[$field]['sorting'];
        }
    }

    public static function getTypeFilter($field)
    {
        $filter = Request::get('filter_column');
        if ($filter[$field]) {
            return $filter[$field]['type'];
        }
    }

    public static function stringBetween($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public static function timeAgo($datetime_to, $datetime_from = NULL, $full = false)
    {
        $datetime_from = ($datetime_from) ?: date('Y-m-d H:i:s');
        $now = new \DateTime;
        if ($datetime_from != '') {
            $now = new \DateTime($datetime_from);
        }
        $ago = new \DateTime($datetime_to);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ' : 'just now';
    }

    public static function sendEmailQueue($queue)
    {
        Config::set('mail.driver', self::getSetting('smtp_driver'));
        Config::set('mail.host', self::getSetting('smtp_host'));
        Config::set('mail.port', self::getSetting('smtp_port'));
        Config::set('mail.username', self::getSetting('smtp_username'));
        Config::set('mail.password', self::getSetting('smtp_password'));

        $html        = $queue->email_content;
        $to          = $queue->email_recipient;
        $subject     = $queue->email_subject;
        $from_email  = $queue->email_from_email;
        $from_name   = $queue->email_from_name;
        $cc_email    = $queue->email_cc_email;
        $attachments = unserialize($queue->email_attachments);

        Mail::send("crudbooster::emails.blank", ['content' => $html], function ($message) use ($html, $to, $subject, $from_email, $from_name, $cc_email, $attachments) {
            $message->priority(1);
            $message->to($to);
            $message->from($from_email, $from_name);
            $message->cc($cc_email);

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

            $message->subject($subject);
        });
    }

    public static function sendEmail($config = [])
    {

        Config::set('mail.driver', self::getSetting('smtp_driver'));
        Config::set('mail.host', self::getSetting('smtp_host'));
        Config::set('mail.port', self::getSetting('smtp_port'));
        Config::set('mail.username', self::getSetting('smtp_username'));
        Config::set('mail.password', self::getSetting('smtp_password'));

        $to = $config['to'];
        $data = $config['data'];
        $template = $config['template'];

        $template = CRUDBooster::first('cms_email_templates', ['slug' => $template]);
        $html = $template->content;
        foreach ($data as $key => $val) {
            $html = str_replace('[' . $key . ']', $val, $html);
            $template->subject = str_replace('[' . $key . ']', $val, $template->subject);
        }
        $subject = $template->subject;
        $attachments = ($config['attachments']) ?: array();

        if ($config['send_at'] != NULL) {
            $a                      = array();
            $a['send_at']           = $config['send_at'];
            $a['email_recipient']   = $to;
            $a['email_from_email']  = $template->from_email ?: CRUDBooster::getSetting('email_sender');
            $a['email_from_name']   = $template->from_name ?: CRUDBooster::getSetting('appname');
            $a['email_cc_email']    = $template->cc_email;
            $a['email_subject']     = $subject;
            $a['email_content']     = $html;
            $a['email_attachments'] = serialize($attachments);
            $a['is_sent']           = 0;
            DB::table('cms_email_queues')->insert($a);
            return true;
        }

        Mail::send("crudbooster::emails.blank", ['content' => $html], function ($message) use ($to, $subject, $template, $attachments) {
            $message->priority(1);
            $message->to($to);

            if ($template->from_email) {
                $from_name = ($template->from_name) ?: CRUDBooster::getSetting('appname');
                $message->from($template->from_email, $from_name);
            }

            if ($template->cc_email) {
                $message->cc($template->cc_email);
            }

            if (count($attachments)) {
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            }

            $message->subject($subject);
        });
    }

    public static function valid($arr = array(), $type = 'json')
    {
        $input_arr = Request::all();

        foreach ($arr as $a => $b) {
            if (is_int($a)) {
                $arr[$b] = 'required';
            } else {
                $arr[$a] = $b;
            }
        }

        $validator = Validator::make($input_arr, $arr);

        if ($validator->fails()) {
            $message = $validator->errors()->all();

            if ($type == 'json') {
                $result = array();
                $result['api_status'] = 0;
                $result['api_message'] = implode(', ', $message);
                $res = response()->json($result, 200);
                $res->send();
                exit;
            } else {
                $res = redirect()->back()
                    ->with(['message' => implode('<br/>', $message), 'message_type' => 'warning'])
                    ->withInput();
                Session::driver()->save();
                $res->send();
                exit;
            }
        }
    }

    public static function parseSqlTable($table)
    {

        $f = explode('.', $table);

        if (count($f) == 1) {
            return array("table" => $f[0], "database" => config('crudbooster.MAIN_DB_DATABASE'));
        } elseif (count($f) == 2) {
            return array("database" => $f[0], "table" => $f[1]);
        } elseif (count($f) == 3) {
            return array("table" => $f[0], "schema" => $f[1], "table" => $f[2]);
        }
        return false;
    }

    public static function putCache($section, $cache_name, $cache_value)
    {
        if (Cache::has($section)) {
            $cache_open = Cache::get($section);
        } else {
            Cache::forever($section, array());
            $cache_open = Cache::get($section);
        }
        $cache_open[$cache_name] = $cache_value;
        Cache::forever($section, $cache_open);
        return true;
    }

    public static function getCache($section, $cache_name)
    {

        if (Cache::has($section)) {
            $cache_open = Cache::get($section);
            return $cache_open[$cache_name];
        } else {
            return false;
        }
    }

    public static function flushCache()
    {
        Cache::flush();
    }

    public static function forgetCache($section, $cache_name)
    {
        if (Cache::has($section)) {
            $open = Cache::get($section);
            unset($open[$cache_name]);
            Cache::forever($section, $open);
            return true;
        } else {
            return false;
        }
    }

    public static function pk($table)
    {
        return self::findPrimaryKey($table);
    }

    public static function findPrimaryKey($table)
    {
        if (!$table) return 'id';

        if (self::getCache('table_' . $table, 'primary_key')) {
            return self::getCache('table_' . $table, 'primary_key');
        }
        $table = CRUDBooster::parseSqlTable($table);

        if (!$table['table']) throw new \Exception("parseSqlTable can't determine the table");
        $query = "select * from information_schema.COLUMNS where TABLE_SCHEMA = '$table[database]' and TABLE_NAME = '$table[table]' and COLUMN_KEY = 'PRI'";
        $keys = DB::select($query);
        $primary_key = $keys[0]->COLUMN_NAME;
        if ($primary_key) {
            self::putCache('table_' . $table, 'primary_key', $primary_key);
            return $primary_key;
        } else {
            return 'id';
        }
    }

    public static function newId($table)
    {
        $key = CRUDBooster::findPrimaryKey($table);
        $id = DB::table($table)->max($key) + 1;
        return $id;
    }

    public static function isColumnExists($table, $field)
    {

        if (!$table) throw new \Exception("\$table is empty !", 1);
        if (!$field) throw new \Exception("\$field is empty !", 1);

        $table = CRUDBooster::parseSqlTable($table);

        // if(self::getCache('table_'.$table,'column_'.$field)) {
        // 	return self::getCache('table_'.$table,'column_'.$field);
        // }

        if (Schema::hasColumn($table['table'], $field)) {
            // self::putCache('table_'.$table,'column_'.$field,1);
            return true;
        } else {
            // self::putCache('table_'.$table,'column_'.$field,0);
            return false;
        }
    }

    public static function getForeignKey($parent_table, $child_table)
    {
        $parent_table = CRUDBooster::parseSqlTable($parent_table)['table'];
        $child_table = CRUDBooster::parseSqlTable($child_table)['table'];
        if (Schema::hasColumn($child_table, 'id_' . $parent_table)) {
            return 'id_' . $parent_table;
        } else {
            return $parent_table . '_id';
        }
    }

    public static function getTableForeignKey($fieldName)
    {
        $table = null;
        if (substr($fieldName, 0, 3) == 'id_') {
            $table = substr($fieldName, 3);
        } elseif (substr($fieldName, -3) == '_id') {
            $table = substr($fieldName, 0, (strlen($fieldName) - 3));
        }
        return $table;
    }

    public static function isForeignKey($fieldName)
    {
        if (substr($fieldName, 0, 3) == 'id_') {
            $table = substr($fieldName, 3);
        } elseif (substr($fieldName, -3) == '_id') {
            $table = substr($fieldName, 0, (strlen($fieldName) - 3));
        }

        if (Cache::has('isForeignKey_' . $fieldName)) {
            return Cache::get('isForeignKey_' . $fieldName);
        } else {
            if ($table) {
                $hasTable = Schema::hasTable($table);
                if ($hasTable) {
                    Cache::forever('isForeignKey_' . $fieldName, true);
                    return true;
                } else {
                    Cache::forever('isForeignKey_' . $fieldName, false);
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public static function urlFilterColumn($key, $type, $value = '', $singleSorting = true)
    {
        $params = Request::all();
        $mainpath = trim(self::mainpath(), '/');

        if ($params['filter_column'] && $singleSorting) {
            foreach ($params['filter_column'] as $k => $filter) {
                foreach ($filter as $t => $val) {
                    if ($t == 'sorting') {
                        unset($params['filter_column'][$k]['sorting']);
                    }
                }
            }
        }


        $params['filter_column'][$key][$type] = $value;

        if (isset($params)) {
            return $mainpath . '?' . http_build_query($params);
        } else {
            return $mainpath . '?filter_column[' . $key . '][' . $type . ']=' . $value;
        }
    }

    public static function insertLog($description, $details = '')
    {
        $a                 = array();
        $a['created_at']   = date('Y-m-d H:i:s');
        $a['ipaddress']    = $_SERVER['REMOTE_ADDR'];
        $a['useragent']    = $_SERVER['HTTP_USER_AGENT'];
        $a['url']          = Request::url();
        $a['description']  = $description;
        $a['details']        = $details;
        $a['id_cms_users'] = self::myId();
        DB::table('cms_logs')->insert($a);
    }

    public static function referer()
    {
        return Request::server('HTTP_REFERER');
    }

    public static function listTables()
    {
        $tables = array();
        $multiple_db = config('crudbooster.MULTIPLE_DATABASE_MODULE');
        $multiple_db = ($multiple_db) ? $multiple_db : array();
        $db_database = config('crudbooster.MAIN_DB_DATABASE');

        if ($multiple_db) {
            try {
                $multiple_db[] = config('crudbooster.MAIN_DB_DATABASE');
                $query_table_schema = implode("','", $multiple_db);
                $tables = DB::select("SELECT CONCAT(TABLE_SCHEMA,'.',TABLE_NAME) FROM INFORMATION_SCHEMA.Tables WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA != 'mysql' AND TABLE_SCHEMA != 'performance_schema' AND TABLE_SCHEMA != 'information_schema' AND TABLE_SCHEMA != 'phpmyadmin' AND TABLE_SCHEMA IN ('$query_table_schema')");
            } catch (\Exception $e) {
                $tables = [];
            }
        } else {
            try {
                $tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.Tables WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = '" . $db_database . "'");
            } catch (\Exception $e) {
                $tables = [];
            }
        }


        return $tables;
    }

    public static function getUrlParameters($exception = NULL)
    {
        @$get = $_GET;
        $inputhtml = '';

        if ($get) {

            if (is_array($exception)) {
                foreach ($exception as $e) {
                    unset($get[$e]);
                }
            }

            $string_parameters = http_build_query($get);
            $string_parameters_array = explode('&', $string_parameters);
            foreach ($string_parameters_array as $s) {
                $part = explode('=', $s);
                $name = urldecode($part[0]);
                $value = urldecode($part[1]);
                if ($name) {
                    $inputhtml .= "<input type='hidden' name='$name' value='$value'/>\n";
                }
            }
        }

        return $inputhtml;
    }

    public static function authAPI()
    {
        if (self::getSetting('api_debug_mode') == 'false') {

            $result = array();
            $validator = Validator::make(
                [

                    'X-Authorization-Token' => Request::header('X-Authorization-Token'),
                    'X-Authorization-Time'  => Request::header('X-Authorization-Time'),
                    'useragent'             => Request::header('User-Agent')
                ],
                [

                    'X-Authorization-Token' => 'required',
                    'X-Authorization-Time'  => 'required',
                    'useragent'             => 'required'
                ]
            );

            if ($validator->fails()) {
                $message = $validator->errors()->all();
                $result['api_status'] = 0;
                $result['api_message'] = implode(', ', $message);
                $res = response()->json($result, 200);
                $res->send();
                exit;
            }

            $user_agent = Request::header('User-Agent');
            $time       = Request::header('X-Authorization-Time');

            $keys = DB::table('cms_apikey')->where('status', 'active')->pluck('screetkey');
            $server_token = array();
            $server_token_screet = array();
            foreach ($keys as $key) {
                $server_token[] = md5($key . $time . $user_agent);
                $server_token_screet[] = $key;
            }

            $sender_token = Request::header('X-Authorization-Token');

            if (!Cache::has($sender_token)) {
                if (!in_array($sender_token, $server_token)) {
                    $result['api_status']   = false;
                    $result['api_message']  = "THE TOKEN IS NOT MATCH WITH SERVER TOKEN";
                    $result['sender_token'] = $sender_token;
                    $result['server_token'] = $server_token;
                    $res = response()->json($result, 200);
                    $res->send();
                    exit;
                }
            } else {
                if (Cache::get($sender_token) != $user_agent) {
                    $result['api_status']   = false;
                    $result['api_message']  = "THE TOKEN IS ALREADY BUT NOT MATCH WITH YOUR DEVICE";
                    $result['sender_token'] = $sender_token;
                    $result['server_token'] = $server_token;
                    $res = response()->json($result, 200);
                    $res->send();
                    exit;
                }
            }

            $id = array_search($sender_token, $server_token);
            $server_screet = $server_token_screet[$id];
            DB::table('cms_apikey')->where('screetkey', $server_screet)->increment('hit');

            $expired_token = date('Y-m-d H:i:s', strtotime('+5 seconds'));
            Cache::put($sender_token, $user_agent, $expired_token);
        }
    }

    public static function sendNotification($config = [])
    {
        $content = $config['content'];
        $to = $config['to'];
        $id_cms_users = $config['id_cms_users'];
        $id_cms_users = ($id_cms_users) ?: [CRUDBooster::myId()];
        foreach ($id_cms_users as $id) {
            $a                         = array();
            $a['created_at']           = date('Y-m-d H:i:s');
            $a['id_cms_users']         = $id;
            $a['content']              = $content;
            $a['is_read']              = 0;
            $a['url']                    = $to;
            DB::table('cms_notifications')->insert($a);
        }
        return true;
    }

    public static function sendFCM($regID, $data)
    {
        if (!$data['title'] || !$data['content']) return 'title , content null !';

        $apikey = CRUDBooster::getSetting('google_fcm_key');
        $url       = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $regID,
            'data' => $data,
            'content_available' => true,
            'notification' => array(
                'sound' => 'default',
                'badge' => 0,
                'title' => trim(strip_tags($data['title'])),
                'body' => trim(strip_tags($data['content']))
            ),
            'priority' => 'high'
        );
        $headers = array(
            'Authorization:key=' . $apikey,
            'Content-Type:application/json'
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $chresult = curl_exec($ch);
        curl_close($ch);
        return $chresult;
    }

    public static function getTableColumns($table)
    {
        //$cols = DB::getSchemaBuilder()->getColumnListing($table);
        $table = CRUDBooster::parseSqlTable($table);
        $cols = collect(DB::select('SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = :database AND TABLE_NAME = :table', ['database' => $table['database'], 'table' => $table['table']]))->map(function ($x) {
            return (array) $x;
        })->toArray();

        $result = array();
        $result = $cols;

        $new_result = array();
        foreach ($result as $ro) {
            $new_result[] = $ro['COLUMN_NAME'];
        }
        return $new_result;
    }

    public static function getNameTable($columns)
    {
        $name_col_candidate = config('crudbooster.NAME_FIELDS_CANDIDATE');
        $name_col_candidate = explode(',', $name_col_candidate);
        $name_col = '';
        foreach ($columns as $c) {
            foreach ($name_col_candidate as $cc) {
                if (strpos($c, $cc) !== FALSE) {
                    $name_col = $c;
                    break;
                }
            }
            if ($name_col) break;
        }
        if ($name_col == '') $name_col = 'id';
        return $name_col;
    }

    public static function isExistsController($table)
    {
        $controllername = ucwords(str_replace('_', ' ', $table));
        $controllername = str_replace(' ', '', $controllername) . 'Controller';
        $path = base_path("app/Http/Controllers/");
        $path2 = base_path("app/Http/Controllers/ControllerMaster/");
        if (file_exists($path . 'Admin' . $controllername . '.php') || file_exists($path2 . 'Admin' . $controllername . '.php') || file_exists($path2 . $controllername . '.php')) {
            return true;
        } else {
            return false;
        }
    }
}
