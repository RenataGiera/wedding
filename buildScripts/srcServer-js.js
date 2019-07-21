const express = require('express');
const path  = require('path');
const open= require('open');

const app = express();
const port = 3000;

app.use(express.static(path.join(__dirname, '../dist')));

app.get('/', function(reg, res) {
    res.sendFile(path.join(__dirname, '../dist/index.html'));
});

app.get('/users', function(req, res){
    res.json ([
        {"id":1,"Name":"Bob", "plusOne":"Eva", "email":"rrr@gmail.com"},
        {"id":2,"Name":"Bob", "plusOne":"Eva", "email":"rrr@gmail.com"},
        {"id":3,"Name":"Bob", "plusOne":"Eva", "email":"rrr@gmail.com"}
    ]);
});

app.listen(port, function(err) {
    if (err) {
        console.log(err);
    } else {
        open('http://localhost:' + port);
    }
})
