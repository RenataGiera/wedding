const express = require('express');
const path  = require('path');
const open= require('open');

const app = express();
const port = 3000;

app.use(express.static(path.join(__dirname, '../dist')));

app.get('/', function(reg, res) {
    res.sendFile(path.join(__dirname, '../dist/index.html'));
});

app.listen(port, function(err) {
    if (err) {
        console.log(err);
    } else {
        open('http://localhost:' + port);
    }
})
