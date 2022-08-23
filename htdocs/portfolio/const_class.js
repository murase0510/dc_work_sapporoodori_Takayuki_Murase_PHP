const four_thouthand = 4000;
const thouthand = 1000;
const five_hundred = 500;

const emp = "emp";
const kirakiraboshi_title = "きらきら星";
const tulip_title = "チューリップ";
const auto_ringing = "自動演奏ボタン";
const stop = "演奏中止";

var sound;
var milli;

class Sounding{
    constructor(milli,sound){
        this.milli = milli;
        this.sound = sound;
    }
}

const kirakiraboshi_score = [
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ラ"),
    new Sounding(five_hundred,"ラ"),
    new Sounding(thouthand,"ソ"),
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(thouthand,"ド"),    
    new Sounding(five_hundred,"ソ"),    
    new Sounding(five_hundred,"ソ"),    
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(thouthand,"レ"),    
    new Sounding(five_hundred,"ソ"),    
    new Sounding(five_hundred,"ソ"),    
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(thouthand,"レ"),    
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ラ"),
    new Sounding(five_hundred,"ラ"),
    new Sounding(thouthand,"ソ"),
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ファ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(four_thouthand,"ド"),  
];

const tulip_score = [
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"レ"),
    new Sounding(thouthand,"ミ"),
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"レ"),
    new Sounding(thouthand,"ミ"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(thouthand,"レ"), 
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"レ"),
    new Sounding(thouthand,"ミ"),
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"レ"),
    new Sounding(thouthand,"ミ"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"ド"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(thouthand,"ド"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"ソ"),
    new Sounding(five_hundred,"ラ"),
    new Sounding(five_hundred,"ラ"),
    new Sounding(thouthand,"ソ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"ミ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(five_hundred,"レ"),
    new Sounding(four_thouthand,"ド")
];
