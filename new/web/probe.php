<?php

/*
 * Active Collab Probe - Checks server requirements for AC5
 *
 * @author Milos Milutinovic
 *
 * @data 2016-09-15
 * 
 * @version 0.2.7.1
 */

//settings

//  ============================================================================
//  No editing below this line
//  ============================================================================
error_reporting(E_ERROR);
//get query
isset($_GET['action']) ? $action = $_GET['action'] : $action = null;

//if action is not set display html

if(isset($action)){
    //html is already sent in previous request, now returning JSON
    class Acm{


        private $url = 'probe.php';

        public function __construct(){
            //check expiration (filemtime)

            //set headers
            header('Content-Type: application/json');

        }

        public function getServerInfo(){
            return json_encode($this->generateServerInfo());
        }

        public function getFileSystemInfo(){
            return json_encode($this->generateFileSystemInfo());
        }


        public function resetOpcache(){
            $status = opcache_reset();

            header('Location: '.$this->url);
            return json_encode($status);
        }

        public function putTest(){
            $status = new stdClass();

            $status->color='success';
            $status->status='OK';

            return json_encode($status);
        }

        public function deleteTest(){
            $status = new stdClass();

            $status->color='success';
            $status->status='OK';

            return json_encode($status);
        }

        //  ======  Private methods ======

        private function generateServerInfo(){
            $sd = new stdClass();

            //version
            $sd->php_version->value = PHP_VERSION;
            if(version_compare($sd->php_version->value, '5.6') < 0){
                $sd->php_version->color = 'danger';
            }
            else{
                $sd->php_version->color = 'success';
            }

            //memory limit
            $sd->memory_limit->value = ini_get('memory_limit');
            if((int) $sd->memory_limit->value < 64){
                $sd->memory_limit->color = 'danger';
            }
            elseif ((int) $sd->memory_limit->value <= 128){
                $sd->memory_limit->color = 'warning';
            }
            else{
                $sd->memory_limit->color = 'success';
            }

            //always populate...
            $sd->always_populate->value = ''; //init, good for php7
            if(version_compare(PHP_VERSION, 7) < 0){
                $sd->always_populate->value = ini_get('always_populate_raw_post_data');

                if($sd->always_populate->value == -1){
                    $sd->always_populate->color = 'success';
                }
                else{
                    $sd->always_populate->color = 'danger';
                }
            }
            else{
                //using php 7
                $sd->always_populate->color = 'success';
            }

            //extensions

            //mysqli
            if(extension_loaded('mysqli')){
                $sd->mysqli->status='OK';
                $sd->mysqli->color="success";
            }
            else{
                $sd->mysqli->status='Error';
                $sd->mysqli->color="danger";   
            }

            //pcre
            if(extension_loaded('pcre')){
                $sd->pcre->status='OK';
                $sd->pcre->color="success";
            }
            else{
                $sd->pcre->status='Error';
                $sd->pcre->color="danger";   
            }

            //tokenizer
            if(extension_loaded('tokenizer')){
                $sd->tokenizer->status='OK';
                $sd->tokenizer->color="success";
            }
            else{
                $sd->tokenizer->status='Error';
                $sd->tokenizer->color="danger";   
            }

            //ctype
            if(extension_loaded('ctype')){
                $sd->ctype->status='OK';
                $sd->ctype->color="success";
            }
            else{
                $sd->ctype->status='Error';
                $sd->ctype->color="danger";   
            }

            //session
            if(extension_loaded('session')){
                $sd->session->status='OK';
                $sd->session->color="success";
            }
            else{
                $sd->session->status='Error';
                $sd->session->color="danger";   
            }

            //json
            if(extension_loaded('json')){
                $sd->json->status='OK';
                $sd->json->color="success";
            }
            else{
                $sd->json->status='Error';
                $sd->json->color="danger";   
            }

            //xml
            if(extension_loaded('xml')){
                $sd->xml->status='OK';
                $sd->xml->color="success";
            }
            else{
                $sd->xml->status='Error';
                $sd->xml->color="danger";   
            }

            //dom
            if(extension_loaded('dom')){
                $sd->dom->status='OK';
                $sd->dom->color="success";
            }
            else{
                $sd->dom->status='Error';
                $sd->dom->color="danger";   
            }

            //phar
            if(extension_loaded('phar')){
                $sd->phar->status='OK';
                $sd->phar->color="success";
            }
            else{
                $sd->phar->status='Error';
                $sd->phar->color="danger";   
            }

            //openssl
            if(extension_loaded('openssl')){
                $sd->openssl->status='OK';
                $sd->openssl->color="success";
            }
            else{
                $sd->openssl->status='Error';
                $sd->openssl->color="danger";   
            }

            //gd
            if(extension_loaded('gd')){
                $sd->gd->status='OK';
                $sd->gd->color="success";
            }
            else{
                $sd->gd->status='Error';
                $sd->gd->color="danger";   
            }

            //mbstring
            if(extension_loaded('mbstring')){
                $sd->mbstring->status='OK';
                $sd->mbstring->color="success";
            }
            else{
                $sd->mbstring->status='Error';
                $sd->mbstring->color="danger";   
            }

            //curl
            if(extension_loaded('curl')){
                $sd->curl->status='OK';
                $sd->curl->color="success";
            }
            else{
                $sd->curl->status='Error';
                $sd->curl->color="danger";   
            }

            //zlib
            if(extension_loaded('zlib')){
                $sd->zlib->status='OK';
                $sd->zlib->color="success";
            }
            else{
                $sd->zlib->status='Error';
                $sd->zlib->color="danger";   
            }

            //fileinfo
            if(extension_loaded('fileinfo')){
                $sd->fileinfo->status='OK';
                $sd->fileinfo->color="success";
            }
            else{
                $sd->fileinfo->status='Error';
                $sd->fileinfo->color="danger";   
            }

            // iconv
            if(extension_loaded('iconv')){
                $sd->iconv->status='OK';
                $sd->iconv->color="success";
            }
            else{
                $sd->iconv->status='Error';
                $sd->iconv->color="danger";   
            }

            //imap
            if(extension_loaded('imap')){
                $sd->imap->status='OK';
                $sd->imap->color="success";
            }
            else{
                $sd->imap->status='Error';
                $sd->imap->color="warning";   
            }

            if(extension_loaded('suhosin')){
                $sd->suhosin->status='Error';
                $sd->suhosin->color='danger';
            }
            else{
                $sd->suhosin->status='OK';
                $sd->suhosin->color='success';   
            }

            //other

            //safe mode - off

            //zend.ze1_compatibility_mode - off

            return $sd;
        }



        private function generateFileSystemInfo(){
            $i = new stdClass();

            $root = __DIR__;

            if(is_writable($root.'/cache')){
                $i->cache->status = 'OK';
                $i->cache->color = 'success';
            }
            else{
                $i->cache->status = 'Error';
                $i->cache->color = 'danger';
            }

            if(is_writable($root.'/compile')){
                $i->compile->status = 'OK';
                $i->compile->color = 'success';
            }
            else{
                $i->compile->status = 'Error';
                $i->compile->color = 'danger';   
            }

            if(is_writable($root.'/config')){
                $i->config->status = 'OK';
                $i->config->color = 'success';
            }
            else{
                $i->config->status = 'Error';
                $i->config->color = 'danger';
            }

            if(is_writable($root.'/logs')){
                $i->logs->status = 'OK';
                $i->logs->color = 'success';
            }
            else{
                $i->logs->status = 'Error';
                $i->logs->color = 'danger';
            }

            if(is_writable($root.'/thumbnails')){
                $i->thumbnails->status = 'OK';
                $i->thumbnails->color = 'success';
            }
            else{
                $i->thumbnails->status = 'Error';
                $i->thumbnails->color = 'danger';
            }

            if(is_writable($root.'/upload')){
                $i->upload->status = 'OK';
                $i->upload->color = 'success';
            }
            else{
                $i->upload->status = 'Error';
                $i->upload->color = 'danger';
            }

            if(is_writable($root.'/work')){
                $i->work->status = 'OK';
                $i->work->color = 'success';
            }
            else{
                $i->work->status = 'Error';
                $i->work->color = 'danger';
            }

            if(is_writable($root.'/activecollab')){
                $i->activecollab->status = 'OK';
                $i->activecollab->color = 'success';
            }
            else{
                $i->activecollab->status = 'Error';
                $i->activecollab->color = 'danger';
            }

            if(is_writable($root.'/public/assets')){
                $i->public->status = 'OK';
                $i->public->color = 'success';
            }
            else{
                $i->public->status = 'Error';
                $i->public->color = 'danger';
            }


            return $i;
        }
    }

    if($action == 'phpinfo'){
        phpinfo();
        die;
    }

    $acm = new Acm($key);

    //routing
    switch($action){
        case 'server-info':
            echo $acm->getServerInfo();
        break;

        case 'license-info':
            echo $acm->getLicenseInfo();
        break;

        case 'filesystem-info':
            echo $acm->getFileSystemInfo();
        break;

        case 'add-user':
            echo $acm->addUser($_GET['email']);
        break;

        case 'list-users':
            echo $acm->listUsers();
        break;

        case 'delete-user':
            echo $acm->deleteUser($_GET['id']);
        break;

        case 'drop-routing-cache':
            echo $acm->dropRoutingCache();
        break;

        case 'reset-opcache-cache':
            echo $acm->resetOpcache();
        break;

        case 'instance-info':
            echo $acm->getInstanceInfo();
        break;

        case 'put-test':
            echo $acm->putTest();
        break;

        case 'delete-test':
            echo $acm->deleteTest();
        break;

        //others

    }

    exit; //ugly but works for now
} //end if


// else{
?><!doctype html>
<html ng-app="acm">
    <head>
        <meta charset="utf-8">
        <title>Active Collab Probe</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>

        <style>
            body{
                background-color: #f4f4f4;
            }
            .table>tbody>tr>td.success{
                background-color: #008800;
                color: white;
            }
            .table>tbody>tr>td.danger{
                background-color: #b00;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Active Collab Probe</h1>
                    <h1>&nbsp;</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <h1>&nbsp;</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <table class="table table-condensed table-bordered" ng-controller="ServerInfoListCtrl">
                        <caption>Server info</caption>
                        <tr>
                            <th>Item</th><th>Value</th>
                        </tr>
                        <tr>
                            <td>Version</td><td class="{{srvinfo.php_version.color}}">{{srvinfo.php_version.value}}</td>
                        </tr>
                        <tr>
                            <td>memory_limit</td><td class="{{srvinfo.memory_limit.color}}">{{srvinfo.memory_limit.value}}</td>
                        </tr>
                        <tr>
                            <td>always_populate_raw_post_data</td><td class="{{srvinfo.always_populate.color}}">{{srvinfo.always_populate.value}}</td>
                        </tr>
                        <tr>
                            <td>mysqli</td><td class="{{srvinfo.mysqli.color}}">{{srvinfo.mysqli.status}}</td>
                        </tr>
                        <tr>
                            <td>pcre</td><td class="{{srvinfo.pcre.color}}">{{srvinfo.pcre.status}}</td>
                        </tr>
                        <tr>
                            <td>tokenizer</td><td class="{{srvinfo.tokenizer.color}}">{{srvinfo.tokenizer.status}}</td>
                        </tr>
                        <tr>
                            <td>ctype</td><td class="{{srvinfo.ctype.color}}">{{srvinfo.ctype.status}}</td>
                        </tr>
                        <tr>
                            <td>session</td><td class="{{srvinfo.session.color}}">{{srvinfo.session.status}}</td>
                        </tr>
                        <tr>
                            <td>json</td><td class="{{srvinfo.json.color}}">{{srvinfo.json.status}}</td>
                        </tr>
                        <tr>
                            <td>xml</td><td class="{{srvinfo.xml.color}}">{{srvinfo.xml.status}}</td>
                        </tr>
                        <tr>
                            <td>dom</td><td class="{{srvinfo.dom.color}}">{{srvinfo.dom.status}}</td>
                        </tr>
                        <tr>
                            <td>phar</td><td class="{{srvinfo.phar.color}}">{{srvinfo.phar.status}}</td>
                        </tr>
                        <tr>
                            <td>openssl</td><td class="{{srvinfo.openssl.color}}">{{srvinfo.openssl.status}}</td>
                        </tr>
                        <tr>
                            <td>gd</td><td class="{{srvinfo.gd.color}}">{{srvinfo.gd.status}}</td>
                        </tr>
                        <tr>
                            <td>mbstring</td><td class="{{srvinfo.mbstring.color}}">{{srvinfo.mbstring.status}}</td>
                        </tr>
                        <tr>
                            <td>curl</td><td class="{{srvinfo.curl.color}}">{{srvinfo.curl.status}}</td>
                        </tr>
                        <tr>
                            <td>zlib</td><td class="{{srvinfo.zlib.color}}">{{srvinfo.zlib.status}}</td>
                        </tr>
                        <tr>
                            <td>fileinfo</td><td class="{{srvinfo.fileinfo.color}}">{{srvinfo.fileinfo.status}}</td>
                        </tr>
                        <tr>
                            <td>iconv</td><td class="{{srvinfo.iconv.color}}">{{srvinfo.iconv.status}}</td>
                        </tr>
                        <tr>
                            <td>imap</td><td class="{{srvinfo.imap.color}}">{{srvinfo.imap.status}}</td>
                        </tr>
                        <tr>
                            <td>suhosin</td><td class="{{srvinfo.suhosin.color}}">{{srvinfo.suhosin.status}}</td>
                        </tr>
                    </table>
                </div><!-- first column -->
                
                <div class="col-lg-6">
                    <table class="table table-condensed table-bordered" ng-controller="FilesystemInfoCtrl">
                        <caption>Filesystem Info</caption>
                        <tr>
                            <th>Folder</th><th>Status</th>
                        </tr>
                        <tr>
                            <td>cache</td><td class="{{fsinfo.cache.color}}">{{fsinfo.cache.status}}</td>
                        </tr>
                        <tr>
                            <td>compile</td><td class="{{fsinfo.compile.color}}">{{fsinfo.compile.status}}</td>
                        </tr>
                        <tr>
                            <td>config</td><td class="{{fsinfo.config.color}}">{{fsinfo.config.status}}</td>
                        </tr>
                        <tr>
                            <td>logs</td><td class="{{fsinfo.logs.color}}">{{fsinfo.logs.status}}</td>
                        </tr>
                        <tr>
                            <td>thumbnails</td><td class="{{fsinfo.thumbnails.color}}">{{fsinfo.thumbnails.status}}</td>
                        </tr>
                        <tr>
                            <td>upload</td><td class="{{fsinfo.upload.color}}">{{fsinfo.upload.status}}</td>
                        </tr>
                        <tr>
                            <td>work</td><td class="{{fsinfo.work.color}}">{{fsinfo.work.status}}</td>
                        </tr>
                        <tr>
                            <td>activecollab</td><td class="{{fsinfo.activecollab.color}}">{{fsinfo.activecollab.status}}</td>
                        </tr>
                        <tr>
                            <td>public/assets</td><td class="{{fsinfo.public.color}}">{{fsinfo.public.status}}</td>
                        </tr>
                    </table>
                    <h3>&nbsp;</h3>
                    <table class="table table-condensed table-bordered">
                        <caption>HTTP Methods</caption>
                        <tr>
                            <th>Method</th><th>Status</th>
                        </tr>
                        <tr ng-controller="PutTestCtrl">
                            <td>PUT</td><td class="{{putTestInfo.color}}">{{putTestInfo.status}}</td>
                        </tr>
                        <tr ng-controller="DeleteTestCtrl">
                            <td>DELETE</td><td class="{{deleteTestInfo.color}}">{{deleteTestInfo.status}}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- second row -->
        </div>

    <script type="text/javascript">
        var acm = angular.module('acm',[]);

        //displaying server info
        acm.controller('ServerInfoListCtrl', function($scope,$http){

            $http.get('<?= $url; ?>?action=server-info').then(function(response){
                $scope.srvinfo = response.data;
            });
        });

        //filesystem info
        acm.controller('FilesystemInfoCtrl', function($scope,$http){

            $http.get('<?= $url; ?>?action=filesystem-info').then(function(response){
                $scope.fsinfo = response.data;
            });
        });

        //http methods
        acm.controller('PutTestCtrl', function($scope,$http){
            $http.put('<?= $url; ?>?action=put-test').then(function(response){
                $scope.putTestInfo = response.data;

                if(!$scope.putTestInfo){
                    $scope.putTestInfo = {
                        status: 'Error',
                        color: 'danger'
                    };
                }
            });


        });

        acm.controller('DeleteTestCtrl', function($scope,$http){
            $http.delete('<?= $url; ?>?action=delete-test').then(function(response){
                $scope.deleteTestInfo = response.data;

                if(!$scope.deleteTestInfo){
                    $scope.deleteTestInfo = {
                        status: 'Error',
                        color: 'danger'
                    };
                }
            });
        });

    </script>
    </body>
</html>

