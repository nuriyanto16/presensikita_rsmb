<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); // This Prevents browsers from directly accessing this PHP file.
/* 
|--------------------------------------------------------------------------
| LICENSE
|--------------------------------------------------------------------------
|     
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
|
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
| GNU General Public License for more details.
|
|  You should have received a copy of the GNU General Public License
| along with this program.  If not, see <http://www.gnu.org/licenses/>.
|-----------------------------------------------------------------------------
| INFORMATIONAL
|-----------------------------------------------------------------------------
| ldap_auth - user authentication using AD/ldap suitable for site wide passwords
| Author: Dwayne Hale
| Library Requirements: CodeIgniter >= v2.0.3
|                       ldap_auth_config.php config file.
| Methods:
|    *  authenticate - authenticate user name and pass word
|    *  info - ldap information about a user
| 
| Usage:
|    load the library by calling:
|       $this->load->library('ldap_auth');
|    somewhere in your controller of your CodeIgniter app before trying to call these functions:
|       $this->ldap_auth->auth($user, $pass);
|    OR
|       $this->ldap_auth->info($user);
*/
class LDAP_auth{
        //takes username and password, returns:
        //true if user could bind to ldap server
        //false if not.
        var $ldapcon= null;  
        var $dn=null;
        var $user_ldap=null;
        var $pass_ldap=null;
        var $email_prefix = null;
        
        public function connect() {
            
            $CI =& get_instance();
            $CI->config->load('ldap_auth');

            $server_ldap = $CI->config->item('server_ldap'); //using domain, If the DC is down DNS will route to another DC.
            $this->user_ldap = $CI->config->item('user_ldap'); //checking for domain. e.g. YOUDOMAIN\YOUNAME
            $this->pass_ldap = $CI->config->item('pass_ldap');
            $this->dn  = $CI->config->item('dn');
            $this->email_prefix = $CI->config->item('email_prefix');
            
            foreach($server_ldap as $server) {
                $this->ldapcon=@ldap_connect($server);
                if($this->ldapcon){
                    break;
                }else{
                    continue;
                }
            }
            
            if($this->ldapcon) {
                ldap_set_option(@$ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option(@$ldap, LDAP_OPT_REFERRALS, 0);
                
                
                return true;

            } else {

                return false;
            }
            
        }
    
        public function auth($username, $password)
        {
                
            $ldapbind = @ldap_bind($this->ldapcon, $this->user_ldap, $this->pass_ldap);
            
            if($ldapbind) {
               
                $sr = ldap_search($this->ldapcon, $this->dn, "samaccountname=$username");
                $info = ldap_get_entries($this->ldapcon, $sr);
                //$cnt = $info['count'];
                
//                $srmail = ldap_search($this->ldapcon, $this->dn, "mail=$username@$this->email_prefix");
//                $infomail = ldap_get_entries($this->ldapcon, $srmail);    
//                $usermail = substr($infomail[0]["mail"][0], 0, strpos($infomail[0]["mail"][0], '@'));
//                
                $bind = @ldap_bind($this->ldapcon, $info[0][dn], $password);
                if($bind) {
                     
                    if (($info[0]["samaccountname"][0] == $username AND $bind) /*AND (@$usermail == $username AND $bind)*/) {
      
                        return true;
                    } else {
                        return false;
                    }
                   
                } else {
                   return false;
                }
                
            }else {
                return false;
            }

        }//END authenticate
       
       // search ldap for given user
       // if found return entries (as array), else return null
        public function info($username, $filter="username") {
             $info = null;
             
             if($filter == "username") {
                 
                $sr = @ldap_search($this->ldapcon, $this->dn,"(&(objectCategory=user)(samAccountName=$username))");
             
                if ($sr){
                   $info = @ldap_get_entries($this->ldapcon, $sr);
                }
                
             } else if($filter == "email") {  
                 
                $sr = ldap_search($this->ldapcon, $this->dn, "mail=$username@$this->email_prefix");
                if ($sr){
                   $info = @ldap_get_entries($this->ldapcon, $sr);
                }
            
             } else {
                 
                $sr = @ldap_search($this->ldapcon, $this->dn,"(&(objectCategory=user)(samAccountName=$username))");
             
                if ($sr){
                   $info = @ldap_get_entries($this->ldapcon, $sr);
                }
             
             }
             
             return $info;
             
        }//END info
         
         //ldap closed
        public function closed() {
         
            @ldap_close($this->ldapcon);

        }
            
   }//END ldap_auth.php