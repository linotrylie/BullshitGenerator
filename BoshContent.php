<?php


class BoshContent
{
    public $title;//文章标题
    public $num;//文章字数
    public function __construct($title,$num)
    {
        $this->title = $title;
        $this->num = $num;
        $this->run();
    }

    public function run(){
        $data = json_decode(file_get_contents('data.json'),true);
        $content = "";
        while(mb_strlen($content) < $this->num) {
            $n = random_int(0,50);
            if($n<10){
                $content .= "\r\n";
            } else if($n<20){
                $f = random_int(0,count($data['famous']));
                $b = random_int(0,count($data['before']));
                $a = random_int(0,count($data['after']));
                $content .= $data['famous'][$f];
                $content = str_ireplace('a',$data['before'][$b],$content);
                $content = str_ireplace('b',$data['after'][$a],$content);
            } else {
                $content .= $data['bosh'][random_int(0,count($data['bosh']))];
            }
            $content = str_ireplace('x',$this->title,$content);
        }

        $file = $this->title.time().".txt";
        file_put_contents($file,$content);
    }

}
$title = "我用PHP做了一个项目";


$num = 500;

$res = new BoshContent($title,$num);

