var express = require('express');
var app = express();
var mysql = require('mysql');


var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: 'crawl'
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
//   let sql = 'select * from lotos';
//   let sql = 'insert into lotos (date,focus,full_data) values (10-10-2010,cuchuoi,cuchuoi1)';

});


app.use(express.static('public'));
app.set('view engine','ejs');
app.set('views','./views');
app.listen(3000);

var request = require('request');
var cheerio = require('cheerio');
function reverse(x) {
    if (x < 0) return -reverse(-x); // reverse(-123) === -reverse(123)
    var str = x.toString(); // "123"
    var strArray = str.split(""); // [ "1", "2", "3" ]
    var revArray = strArray.reverse(); // [ "3", "2", "1" ]
    var rev = revArray.join(""); // "321"
    return rev;
  }
app.get('/test',function(req,res){ //test?month=10&year=2010
    console.log(req.query.month,req.query.year);
    const month = req.query.month;
    const year = req.query.year;
    for (let index = 1; index <= 31; index++) {
        let url = "https://ketqua.net/xo-so-truyen-thong.php?ngay="+index+'-'+month+'-'+year; //https://ketqua.net/xo-so-truyen-thong.php?ngay=17-07-2020
        request(url,function(err,resp,body){
        if(err){
            console.log(err);
        }else{
            $ = cheerio.load(body);
            var ds = $(body).find('td.phoi-size.chu22');
            let arr_focus = [];
            let arr_full = [];
            ds.each(function(i,e){
                // console.log($(this).text());
                let aaa = $(this).text();
                aaa = reverse(aaa);
                const bbb = aaa[1]+aaa[0];
                arr_full.push(Number(bbb));
                if(i>22){
                    arr_focus.push(Number(bbb));
                }
            })
            const date = year+'-'+month+'-'+index;
            const focus = JSON.stringify(arr_focus);
            const full = JSON.stringify(arr_full);
            let sql = "INSERT INTO `lotos` (`id`, `date`, `focus`, `all_data`) VALUES (NULL, '"+date+"', '"+focus+"', '"+full+"');";
            con.query(sql, function (err, result) {
                if (err) throw err;
                console.log("Result: " + result);
            });
            console.log(111,focus);
            console.log(222,full);
            console.log(333,sql);
            }
        });
    }

    
    
});