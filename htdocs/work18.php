<?php
    class for_print{
        public $first_customers;
        public $second_customers;
        public $third_customers;
        public $customers;
        public $max_page;

        public function __construct() {
            $this->first_customers = [new customer('佐藤',10),new customer('鈴木',15),new customer('高橋',20)];
            $this->second_customers = [new customer('田中',25),new customer('伊藤',30),new customer('渡辺',35)];
            $this->third_customers = [new customer('山本',40)];
            $this->customers = [$this->first_customers,$this->second_customers,$this->third_customers];
            $this->max_page = sizeof($this->customers);
          }

        function print_customer($page_num){
            echo '<table border="1">';
            echo '<thead>';
            for($i = 0 ; $i < sizeof($this->customers[$page_num]); $i++){
                echo '<tr valign="top">';
                echo '<td width="100" height="80">';
                echo $this->customers[$page_num][$i]->name;
                echo '</td>';
                echo '<td width="100" height="80">';
                echo $this->customers[$page_num][$i]->age;
                echo '</td>';
                echo '</tr>';
            }
            echo '</thead>';
            echo '</table>';
        }
    }

    class customer{
        public $name;
        public $age;

        public function __construct($name,$age) {
            $this->name = $name;
            $this->age = $age;
          }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work18</title>
</head>
<body>
    <form method="get">
            <?php
                $page = 1;
                $fp = new for_print();
                if (isset($_GET["page"]) &&$_GET["page"] > 0){
                    $page = (int)$_GET["page"];
                    $fp->print_customer($page - 1);
                }else{
                    $fp->print_customer(0);
                }
                echo $page;
                echo '<ul style = "display:inline;">';
                if($page == 1){
                    echo '<li style = "display:inline;">前へ</li>';
                }else{
                    echo '<li style = "display:inline;">';
                    echo '<a href=?page=';
                    echo $page - 1;
                    echo '>';
                    echo '前へ';
                    echo '</a>';
                    echo '</li>';
                }
                
                for($i = 0 ; $i < $fp->max_page; $i++){
                    if($page == $i + 1){
                        echo '<li style = "display:inline;">';
                        echo $i + 1;
                        echo '</li>';
                    }else{
                        echo '<li style = "display:inline;">';
                        echo '<a href=?page=';
                        echo $i + 1;
                        echo '>';
                        echo $i + 1;
                        echo '</a>';
                        echo '</li>';
                    }
                }

                if($page == 3){
                    echo '<li style = "display:inline;">次へ</li>';
                }else{
                    echo '<li style = "display:inline;">';
                    echo '<a href=?page=';
                    echo $page + 1;
                    echo '>';
                    echo '次へ';
                    echo '</a>';
                    echo '</li>';
                }
            ?>
        </ul>
    </form>


</body>
</html>