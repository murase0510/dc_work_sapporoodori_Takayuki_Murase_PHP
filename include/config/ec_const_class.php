<?php
    class ec_const_class{
        public const HOST = 'mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp';
        public const LOGIN_USER = 'bcdhm_sapporo_pf0001';
        public const PASSWORD = 'A7c2b#Nw';

        public const CREATE_PRE_USER = "insert into pre_user(urltoken, mail, date, isUsed)values(:urltoken, :mail, now(), '0');";
        public const IS_USED_MAIL = "SELECT user_id FROM  ec_Authenticated_user WHERE mail=:mail";
        public const GET_URLTOKEN_BY_MAILADDLESS = "SELECT urltoken FROM pre_user WHERE mail = :mail and isUsed = 0";
        public const GET_URLTOKEN_AT_CHANGE_PASSWORD_BY_MAILADDLESS = "SELECT urltoken FROM change_password WHERE mail = :mail and isUsed = 0";
        public const IS_ARRIVE_FROM_MAIL = "SELECT * FROM pre_user where urltoken = :urltoken";
        public const IS_ARRIVE_FROM_MAIL_FOR_CHANGE_PASSWORD = "SELECT * FROM change_password where urltoken = :urltoken and isused = 0";
        public const CREATE_AUTHENTICATED_USER = "insert into ec_Authenticated_user(user_name,password,create_date,update_date,mail) value( :user_name, :password, now(),now(), :mail)";
        //public const IS_USED_ID = "SELECT user_id FROM ec_Authenticated_user WHERE user_id = :user_id";
        public const SWITCH_ISUSED = "UPDATE pre_user SET isUsed = 1 WHERE mail = :mail";
        public const SWITCH_ISUSED_AT_CHANGE_PASSWORD = "UPDATE change_password SET isUsed = 1 WHERE mail = :mail";
        public const SWITCH_ISPRE = "UPDATE ec_Authenticated_user SET isPre = 0 WHERE mail = :mail";
        public const CREATE_CHANGE_PASSWORD = "insert into change_password(urltoken, mail, date, isUsed)values(:urltoken, :mail, now(), '0');";
        public const CHANGE_PASSWORD = "UPDATE ec_Authenticated_user SET password = :password WHERE mail = :mail";
        public const GET_PASSWORD = "SELECT password from ec_Authenticated_user WHERE mail = :mail";
        public const CREATE_PRODUCT = "INSERT INTO ec_product(product_name,price,public_flag,create_date,update_date)values(:product_name,:price,:public_flag,now(),now());";
        public const SET_IMAGE = "INSERT INTO product_image(product_id,create_day,image,image_name)values(:product_id,now(),:image,:image_name);";
        public const GET_ALL_IMAGE = "SELECT * FROM product_image";
        public const GET_ONE_EC_PRODUCT = "SELECT * FROM ec_product where product_id = :product_id";
        public const GET_ONE_EC_STOCK = "SELECT * FROM ec_stock where product_id = :product_id";
        public const CREATE_EC_STOCK = "INSERT INTO ec_stock(product_id,stock,create_date,update_date)value(:product_id,:stock,now(),now())";
        public const UPDATE_STOCK = "UPDATE ec_stock SET stock = :stock, update_date = now() WHERE stock_id = :stock_id";
        public const CHANGE_PRODUCT_FLAG = "UPDATE ec_product SET public_flag = :public_flag WHERE product_id = :product_id";
        public const DELETE_PRODUCT = "DELETE FROM ec_product WHERE product_id = :product_id";
        public const DELETE_STOCK = "DELETE FROM ec_stock WHERE product_id = :product_id";
        public const DELETE_IMAGE = "DELETE FROM product_image WHERE product_id = :product_id";
        public const GET_ALL_PRODUCT = "SELECT * FROM ec_product";
        public const GET_ONE_IMAGE = "SELECT * FROM product_image where product_id = :product_id";

        public const URL = 'https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/register_account.php?urltoken=';
        public const CHANGE_PASS_URL = 'https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/change_password.php?urltoken=';

        public const SENDING_MAIL = "it-sapporoodori108@dc-itex.com";

        public const EC_ADMIN = "ec_admin";
    }
?>