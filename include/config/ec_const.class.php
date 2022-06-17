<?php
    class ec_const{
        public const HOST = 'mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp';
        public const LOGIN_USER = 'bcdhm_sapporo_pf0001';
        public const PASSWORD = 'A7c2b#Nw';

        public const CREATE_PRE_USER = "insert into pre_user(urltoken, mail, date, flag)values(:urltoken, :mail, now(), '0');";
        public const IS_USED_MAIL = "SELECT id FROM  ec_Authenticated_user WHERE mail=:mail";
        public const GET_URLTOKEN_BY_MAILADDLESS = "SELECT urltoken FROM pre_user WHERE mail = :mail";
        public const IS_ARRIVE_FROM_MAIL = "SELECT * FROM urltoken where urltoken = :urltoken";
        public const CREATE_AUTHENTICATED_USER = "insert into ec_Authenticated_user(user_id,user_name,password,create_date,update_date) value(:user_id, :user_name, :password, now(),now())";
        public const IS_USED_ID = "SELECT user_id FROM ec_Authenticated_user WHERE user_id = :user_id";

        public const URL = 'https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/register_account.php?urltoken=';

        public const SENDING_MAIL = "it-sapporoodori108@dc-itex.com";
    }



?>