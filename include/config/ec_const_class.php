<?php
    class ec_const_class{
        public const HOST = 'mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp';
        public const LOGIN_USER = 'bcdhm_sapporo_pf0001';
        public const PASSWORD = 'A7c2b#Nw';

        public const CREATE_PRE_USER = "insert into pre_user(urltoken, mail, date, isUsed)values(:urltoken, :mail, now(), '0');";
        public const IS_USED_MAIL = "SELECT user_id FROM  ec_Authenticated_user WHERE mail=:mail";
        public const GET_URLTOKEN_BY_MAILADDLESS = "SELECT urltoken FROM pre_user WHERE mail = :mail and isUsed = 0";
        public const GET_URLTOKEN_AT_CHANGE_PASSWORD_BY_MAILADDLESS = "SELECT urltoken FROM change_password WHERE mail = :mail and isUsed = 0";
        public const IS_ARRIVE_FROM_MAIL = "SELECT * FROM pre_user where urltoken = :urltoken and isUsed = 0";
        public const IS_ARRIVE_FROM_MAIL_FOR_CHANGE_PASSWORD = "SELECT * FROM change_password where urltoken = :urltoken and isused = 0";
        public const CREATE_AUTHENTICATED_USER = "insert into ec_Authenticated_user(user_name,password,create_date,update_date,mail) value( :user_name, :password, now(),now(), :mail)";
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
        public const CREATE_CART = "INSERT INTO cart(user_id,create_date,update_date) VALUE(:user_id,now(),now())";
        public const CREATE_CART_PRODUCT_CHUKAN = "INSERT INTO cart_product_chukan(cart_id,product_id,Purchase_number)VALUE(:cart_id,:product_id,1)";
        public const GET_ONE_AUTHENTICATED_USER = "SELECT * FROM ec_Authenticated_user where mail = :mail";
        public const GET_ONE_CART = "SELECT * FROM cart where user_id = :user_id";
        public const GET_CART_PRODUCT_CHUKAN_BY_CARTID ="SELECT * FROM cart_product_chukan where cart_id = :cart_id and purchase_date = '1000-01-01 00:00:00'";
        public const UPDATE_CART_PRODUCT_CHUKAN_PURCHASE_NUMBER = "UPDATE cart_product_chukan SET Purchase_number = :Purchase_number WHERE cart_id = :cart_id and product_id = :product_id and purchase_date = '1000-01-01 00:00:00'";
        public const DELETE_CART_PRODUCT_CHUKAN = "DELETE FROM cart_product_chukan WHERE cart_id = :cart_id and product_id = :product_id and purchase_date = '1000-01-01 00:00:00'";
        public const GET_ONE_CART_PRODUCT_CHUKAN = "SELECT * FROM cart_product_chukan where cart_id = :cart_id AND product_id = :product_id and purchase_date = '1000-01-01 00:00:00'";
        public const PLUS_ONE_CART_PRODUCT_CHUKAN_PURCHASE_NUMBER = "UPDATE cart_product_chukan SET Purchase_number = Purchase_number + 1 WHERE cart_id = :cart_id and product_id = :product_id and purchase_date = '1000-01-01 00:00:00'";
        public const UPDATE_PRODUCT_CHUKAN_PURCHASE_DATE = "UPDATE cart_product_chukan SET purchase_date = now() WHERE cart_id = :cart_id  and purchase_date = '1000-01-01 00:00:00'";
        public const MINUS_STOCK = "UPDATE ec_stock SET stock = stock - :num WHERE product_id = :product_id";
        public const IS_AUTHENTICATED_USER = "SELECT isPre FROM  ec_Authenticated_user WHERE mail=:mail";

        public const URL = 'https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/register_account.php?urltoken=';
        public const CHANGE_PASS_URL = 'https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/change_password.php?urltoken=';

        public const SENDING_MAIL = "it-sapporoodori108@dc-itex.com";

        public const EC_ADMIN = "ec_admin";

        public const EC_DBACCESSER_PATH = "../include/model/ec_DBAccesser_class.php";
        public const EC_CALC_TOTAL_COST_PATH = "../include/model/ec_calc_total_cost_class.php";
        public const EC_NO_SESSION_PATH = "../include/model/ec_no_session_class.php";
        public const EC_SEND_MAIL_PATH = "../include/model/ec_send_mail_class.php";
        public const EC_IS_MORE_STOCK_THAN_PURCHASE_NUMBER_PATH = "../include/model/ec_is_more_stock_than_purchase_number_class.php";
        public const EC_IS_TRUST_ACCOUNT_PATH = "../include/model/ec_is_trust_account_class.php";

        public const EC_CHANGE_PASSWORD_PATH = "../include/view/ec_change_password_class.php";
        public const EC_PRINT_ADMIN_FORM_PATH = "../include/view/ec_print_admin_form_class.php";
        public const EC_PRINT_PURCHASE_COMPLETE_PATH = "../include/view/ec_print_purchase_complete_class.php";
        public const EC_PRINT_SHOPPING_CART_PATH = "../include/view/ec_print_shopping_cart_class.php";
        public const EC_PRODUCT_LIST_PATH = "../include/view/ec_product_list_class.php";
        public const EC_REGISTER_ACCOUNT_PATH = "../include/view/ec_register_account_class.php";
        public const EC_PRINT_ERROR_MESSAGE_LOGIN = "../include/view/ec_print_error_message_login_class.php";
        public const EC_PRINT_ERROR_MESSAGE_ADMIN_FORM = "../include/view/ec_print_error_message_admin_form_class.php";
        public const EC_PRINT_ERROR_MESSAGE_APPLY_FOR_CHANGE_PASSWORD = "../include/view/ec_print_error_message_Apply_for_change_password_class.php";
        public const EC_PRINT_ERROR_MESSAGE_CREATE_ACCOUNT = "../include/view/ec_print_error_message_create_account_class.php";

        public const LOCATION_LOGIN = "Location: ./login.php";
        public const LOCATION_APPLIED_FOR_CHANGE_PASSWORD = "Location: ./Applied_for_change_password.html";
        public const LOCATION_CHANGED_PASSWORD = "Location: ./changed_password.html";
        public const LOCATION_CREATE_PRE_ACCOUNT = "Location: ./created_pre_account.html";
        public const LOCATION_PRODUCT_LIST = "Location: ./product_list.php";
        public const LOCATION_ADMIN_FORM = "Location: ./admin_form.php";
        public const LOCATION_LOGOUT = "Location: ./logout.php";
        public const LOCATION_PURCHASE_COMPLETE = "Location: ./purchase_complete.php";

        public const SESSION_MAIL = "mail";
        public const SESSION_CART_ID = "cart_id";
        public const SESSION_USER_ID = "user_id";

        public const HTTP_POST = "POST";
        public const REQUEST_METHOD = "REQUEST_METHOD";

        public const DB_USER_ID = "user_id";
        public const DB_CART_ID = "cart_id";
        public const DB_PRODUCT_ID = "product_id";
        public const DB_PRICE = "price";
        public const DB_PURCHASE_NUMBER = "Purchase_number";
        public const DB_ID = "id";
        public const DB_CP_ID = "cp_id";
        public const DB_PASSWORD = "password";
        public const DB_PUBLIC_FLAG = "public_flag";
        public const DB_IMAGE = "image";
        public const DB_PRODUCT_NAME = "product_name";
        public const DB_STOCK = 'stock';
        public const DB_STOCK_ID = 'stock_id';
        public const DB_URLTOKEN = 'urltoken';

        public const DB_BIND_URLTOKEN = ":urltoken";
        public const DB_BIND_MAIL = ":mail";
        public const DB_BIND_USER_NAME = ":user_name";
        public const DB_BIND_PASSWORD = ":password";
        public const DB_BIND_PRODUCT_NAME = ':product_name';
        public const DB_BIND_PRICE = ':price';
        public const DB_BIND_PUBLIC_FLAG = ':public_flag';
        public const DB_BIND_PRODUCT_ID = ':product_id';
        public const DB_BIND_IMAGE = ':image';
        public const DB_BIND_IMAGE_NAME = ':image_name';
        public const DB_BIND_STOCK = ':stock';
        public const DB_BIND_STOCK_ID = ':stock_id';
        public const DB_BIND_USER_ID = ':user_id';
        public const DB_BIND_CART_ID = ":cart_id";
        public const DB_BIND_PURCHASE_NUMBER = ':Purchase_number';
        public const DB_BIND_NUM = ':num';

        public const ATTRIBUTE_NAME_MAIL = "mail";
        public const ATTRIBUTE_NAME_PASSWORD = "password";
        public const ATTRIBUTE_NAME_POST_PRODUCT = "post_product";
        public const ATTRIBUTE_NAME_PRODUCT_NAME = "product_name";
        public const ATTRIBUTE_NAME_PRODUCT_PRICE = "product_price";
        public const ATTRIBUTE_NAME_PRODUCT_STOCK = "product_stock";
        public const ATTRIBUTE_NAME_PRODUCT_IMAGE = "product_image";
        public const ATTRIBUTE_NAME_RELEASE = "Release";
        public const ATTRIBUTE_NAME_CHANGE_STOCK = "change_stock";
        public const ATTRIBUTE_NAME_STOCK = "stock";
        public const ATTRIBUTE_NAME_SWITCH_FLAG_BUTTON = "switch_flag_button";
        public const ATTRIBUTE_NAME_DELETE_PRODUCT_BUTTON = "delete_product_button";
        public const ATTRIBUTE_NAME_URLTOKEN = "urltoken";
        public const ATTRIBUTE_NAME_CHANGE = "change";
        public const ATTRIBUTE_NAME_USER_NAME = "user_name";
        public const ATTRIBUTE_NAME_IN_CART_BUTTON = 'in_cart_button';
        public const ATTRIBUTE_NAME_POST_PURCHASE_NUMBER = 'post_Purchase_number';
        public const ATTRIBUTE_NAME_PURCHASE_NUMBER = 'Purchase_number';
        public const ATTRIBUTE_NAME_DELETE_BUTTON = 'delete_button';
        public const ATTRIBUTE_NAME_ADJUSTMENT = 'adjustment';

        public const FILE_UPLOAD_VALIABLE_NAME = "name";
        public const FILE_UPLOAD_VALIABLE_TMP_NAME = "tmp_name";

        public const LANG_JA = "ja";
        public const ENCODE_UTF8 = "UTF-8";
        public const COOKIE_VALIABLE_PHPSESSID = "PHPSESSID";
        public const MAIL_MATCH_PATURN = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";

        public const IMAGE_FORMAT_JPG = ".jpg";
        public const IMAGE_FORMAT_PNG = ".png";
    }
?>