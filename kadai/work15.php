<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work15</title>
</head>
<body>
    <?php 
        $class1 = [new student('tokugawa'),new student('oda'),new student('toyotomi'),new student('takeda')];
        $class2 = [new student('minamoto'),new student('taira'),new student('sugawara'),new student('fujiwara')];
        $school = [$class1,$class2];
        $ave = 0;

        if($school[0][1]->score > $school[1][2]->score){
            print($school[0][1]->name.'さんの点数が高いです');
        }else if($school[0][1]->score < $school[1][2]->score){
            print($school[1][2]->name.'さんの点数が高いです');
        }else{
            print($school[0][1]->name.'さんと'.$school[1][2]->name.'さんの点数は同じです');
        }

        for($i = 0; $i < count($school); $i++){
            for($s = 0; $s < count($school[$i]); $s++){
                $ave = $ave + $school[$i][$s]->score;
            }
        }
        
        print('<br>');
        print($ave / (count($school[0]) + count($school[1])));

        class student{
            public $name;
            public $score;

            public function __construct($name) {
                $this->name = $name;
                $this->score = rand(1,100);
              }
        }
    ?>
</body>
</html>